<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Throwable;

// Models
use App\Models\PessoaFisica;
use App\Models\Endereco;

class PessoaFisicaController extends Controller
{
    /**
     * Exibir a lista de Pessoas Físicas
     */
    public function index()
    {
        return view('urbnex.pessoas-fisicas.index');
    }

    // Endpoint para buscar Pessoas Físicas
    public function getData(Request $request)
    {
        if ($request->ajax()) {
            $data = PessoaFisica::select(['id', 'nome', 'cpf_cin']);
            
            return DataTables::of($data)
                ->addColumn('actions', function ($row) {
                    $btn  = '<a href="'.route('pessoas.show', $row->id).'" class="btn btn-sm btn-info">Ver</a> ';
                    $btn .= '<a href="'.route('pessoas.edit', $row->id).'" class="btn btn-sm btn-warning">Editar</a> ';
                    $btn .= '<button data-id="'.$row->id.'" class="btn btn-sm btn-danger btnDelete">Excluir</button>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
    }


    public function getPessoas(Request $request)
    {
        $limit = (int) $request->input('limit', 12);
        $limit = max(1, min($limit, 100));

        $page = (int) $request->input('page', 1);
        $page = max(1, $page);

        $search = trim((string) $request->input('search', ''));

        $query = PessoaFisica::query();

        if ($search !== '') {
            $query->where(function($q) use ($search) {
                $like = '%'.$search.'%';
                $q->where('nome', 'like', $like)
                ->orWhere('cpf_cin', 'like', $like)
                ->orWhere('rg', 'like', $like)
                ->orWhere('email', 'like', $like)
                ->orWhere('telefone', 'like', $like);
            });
        }

        // Ordenação opcional vinda do front
        $allowedSorts = ['id','nome','cpf_cin','rg','email','telefone'];
        $sort = $request->input('sort', 'id');
        $order = strtolower($request->input('order', 'desc')) === 'asc' ? 'asc' : 'desc';

        if (!in_array($sort, $allowedSorts, true)) {
            $sort = 'id';
        }
        $query->orderBy($sort, $order);

        $pessoas = $query->paginate($limit, ['*'], 'page', $page);

        return response()->json([
            'data'          => $pessoas->items(),
            'total'         => $pessoas->total(),
            'current_page'  => $pessoas->currentPage(),
            'last_page'     => $pessoas->lastPage(),
            'per_page'      => $pessoas->perPage(),
        ]);
    }

    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        $paisesOrigem = config('selects.paises_origem');
        $profissoesMasculinas = config('selects.profissoes_masculinas');
        $profissoesFemininas = config('selects.profissoes_femininas');
        $estadosCivisMasculinos = config('selects.estados_civis_masculinos');
        $estadosCivisFemininos = config('selects.estados_civis_femininos');
        $enderecos = Endereco::all();

        return view('urbnex.pessoas-fisicas.create', compact('paisesOrigem', 'profissoesMasculinas', 'profissoesFemininas', 'estadosCivisMasculinos', 'estadosCivisFemininos', 'enderecos'));
    }

    /**
     * Salvar Pessoa Física
     */
    public function store(Request $request)
    {
        // Validação
        $validated = $request->validate([
              // Pessoa Física
            'nome'         => 'required|string|max:255',
            'genero'       => ['required', Rule::in(['m', 'f'])],
            'pais_origem'  => 'required|string',
            'cpf_cin'      => 'required|string|max:14|unique:pessoas_fisicas,cpf_cin',
            'rg'           => 'nullable|string|max:14|unique:pessoas_fisicas,rg',
            'rne_crnm'     => 'nullable|string|max:14|unique:pessoas_fisicas,rne_crnm',
            'cnh'          => 'nullable|string|max:14|unique:pessoas_fisicas,cnh',
            'passaporte'   => 'nullable|string|max:14|unique:pessoas_fisicas,passaporte',
            'estado_civil' => 'required|string|max:255',
            'profissao'    => 'required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'telefone_1'   => 'nullable|string|max:15',
            'telefone_2'   => 'nullable|string|max:15',

            // Endereço
            'cep'         => 'required|string|max:9',
            'logradouro'  => 'required|string|max:255',
            'numero'      => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro'      => 'required|string|max:255',
            'cidade'      => 'required|string|max:255',
            'estado'      => 'required|string|max:2'
        ]);

        DB::beginTransaction();

        try {
            // Criação do endereço
            $endereco = Endereco::create([
                'cep'         => $validated['cep'],
                'logradouro'  => $validated['logradouro'],
                'numero'      => $validated['numero'],
                'complemento' => $validated['complemento'] ?? null,
                'bairro'      => $validated['bairro'],
                'cidade'      => $validated['cidade'],
                'estado'      => $validated['estado'],
            ]);

            // Buscar país e nacionalidade
            $paisSelecionado = collect(config('selects.paises_origem'))
                ->first(fn($pais) => strcasecmp($pais['value'], trim($validated['pais_origem'])) === 0);

            $nacionalidade = $paisSelecionado['nacionalidade'][$validated['genero']] ?? 'N/A';

            dd($request->all());

            // Criação da pessoa física
            PessoaFisica::create([
                'nome'          => $validated['nome'],
                'genero'        => $validated['genero'],
                'pais_origem'   => $validated['pais_origem'],
                'nacionalidade' => $nacionalidade,
                'cpf_cin'       => $validated['cpf_cin'],
                'rg'            => $validated['rg'] ?? null,
                'rne_crnm'      => $validated['rne_crnm'] ?? null,
                'cnh'           => $validated['cnh'] ?? null,
                'passaporte'    => $validated['passaporte'] ?? null,
                'estado_civil'  => $validated['estado_civil'],
                'profissao'     => $validated['profissao'],
                'email'         => $validated['email'] ?? null,
                'telefone_1'    => $validated['telefone_1'] ?? null,
                'telefone_2'    => $validated['telefone_2'] ?? null,
                'endereco_id'   => $endereco->id,
            ]);

            DB::commit();

            return redirect()->route('pessoasFisicas.index')
                ->with('success', 'Pessoa Física criada com sucesso!');

        } catch (\Throwable $e) {
            DB::rollBack();

            // Log do erro
            Log::error('Erro ao criar Pessoa Física', ['exception' => $e]);

            // Em desenvolvimento, mostra erro detalhado
            if (app()->environment('local')) {
                throw $e;
            }

            // Em produção, mensagem genérica
            return redirect()->back()
                ->with('error', 'Ocorreu um erro inesperado. Tente novamente mais tarde.')
                ->withInput();
        }
    }

    /**
     * Exibir formulário de edição
     */
    public function edit(PessoaFisica $pessoaFisica)
    {
        $paisesOrigem = config('selects.paises_origem');
        $profissoesMasculinas = config('selects.profissoes_masculinas');
        $profissoesFemininas = config('selects.profissoes_femininas');
        $estadosCivisMasculinos = config('selects.estados_civis_masculinos');
        $estadosCivisFemininos = config('selects.estados_civis_femininos');
        $enderecos = Endereco::all();
        return view('pessoas-fisicas.edit', compact('pessoaFisica', 'paisesOrigem', 'profissoesMasculinas', 'profissoesFemininas', 'estadosCivisMasculinos', 'estadosCivisFemininos', 'enderecos'));
    }

    /**
     * Atualizar Pessoa Física
     */
    public function update(Request $request, PessoaFisica $pessoaFisica)
    {
        // Validação
        $validated = $request->validate([
            // Pessoa Física
            'nome'         => 'required|string|max:255',
            'genero'       => ['required', Rule::in(['m', 'f'])],
            'pais_origem'  => 'required|string',
            'cpf_cin'      => ['required','string','max:14', Rule::unique('pessoas_fisicas','cpf_cin')->ignore($pessoaFisica->id)],
            'rg'           => ['nullable','string','max:14', Rule::unique('pessoas_fisicas','rg')->ignore($pessoaFisica->id)],
            'rne_crnm'     => ['nullable','string','max:14', Rule::unique('pessoas_fisicas','rne_crnm')->ignore($pessoaFisica->id)],
            'cnh'          => ['nullable','string','max:14', Rule::unique('pessoas_fisicas','cnh')->ignore($pessoaFisica->id)],
            'passaporte'   => ['nullable','string','max:14', Rule::unique('pessoas_fisicas','passaporte')->ignore($pessoaFisica->id)],
            'estado_civil' => 'required|string|max:255',
            'profissao'    => 'required|string|max:255',
            'email'        => 'nullable|email|max:255',
            'telefone'     => 'nullable|string|max:15',

            // Endereço
            'cep'         => 'required|string|max:9',
            'logradouro'  => 'required|string|max:255',
            'numero'      => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'bairro'      => 'required|string|max:255',
            'cidade'      => 'required|string|max:255',
            'estado'      => 'required|string|max:2'
        ]);

        DB::beginTransaction();

        try {
            // Atualização do endereço
            $endereco = $pessoaFisica->endereco;
            $endereco->update([
                'cep'         => $validated['cep'],
                'logradouro'  => $validated['logradouro'],
                'numero'      => $validated['numero'],
                'complemento' => $validated['complemento'] ?? null,
                'bairro'      => $validated['bairro'],
                'cidade'      => $validated['cidade'],
                'estado'      => $validated['estado'],
            ]);

            // Buscar país e nacionalidade
            $paisSelecionado = collect(config('selects.paises_origem'))
                ->first(fn($pais) => strcasecmp($pais['value'], trim($validated['pais_origem'])) === 0);

            $nacionalidade = $paisSelecionado['nacionalidade'][$validated['genero']] ?? 'N/A';

            // Atualização da pessoa física
            $pessoaFisica->update([
                'nome'          => $validated['nome'],
                'genero'        => $validated['genero'],
                'pais_origem'   => $validated['pais_origem'],
                'nacionalidade' => $nacionalidade,
                'cpf_cin'       => $validated['cpf_cin'],
                'rg'            => $validated['rg'] ?? null,
                'rne_crnm'      => $validated['rne_crnm'] ?? null,
                'cnh'           => $validated['cnh'] ?? null,
                'passaporte'    => $validated['passaporte'] ?? null,
                'estado_civil'  => $validated['estado_civil'],
                'profissao'     => $validated['profissao'],
                'email'         => $validated['email'] ?? null,
                'telefone'      => $validated['telefone'] ?? null,
            ]);

            DB::commit();

            return redirect()->route('pessoasFisicas.index')
                ->with('success', 'Pessoa Física atualizada com sucesso!');

        } catch (\Throwable $e) {
            DB::rollBack();

            // Log do erro
            Log::error('Erro ao atualizar Pessoa Física', ['exception' => $e]);

            // Em desenvolvimento, mostra erro detalhado
            if (app()->environment('local')) {
                throw $e;
            }

            // Em produção, mensagem genérica
            return redirect()->back()
                ->with('error', 'Ocorreu um erro inesperado. Tente novamente mais tarde.')
                ->withInput();
        }
    }


    /**
     * Deletar Pessoa Física
     */
    public function destroy(PessoaFisica $pessoaFisica)
    {
        $pessoaFisica->delete();

        return redirect()->route('pessoas-fisicas.index')
                         ->with('success', 'Pessoa Física removida com sucesso!');
    }
}
