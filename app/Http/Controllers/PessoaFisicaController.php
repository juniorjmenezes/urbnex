<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\PessoaFisica;
use App\Models\Endereco;

class PessoaFisicaController extends Controller
{
    /**
     * Exibir a lista de Pessoas Jurídicas
     */
    public function index()
    {
        return view('pessoas-fisicas.index');
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
                ->orWhere('cpf', 'like', $like)
                ->orWhere('rg', 'like', $like)
                ->orWhere('email', 'like', $like)
                ->orWhere('telefone', 'like', $like);
            });
        }

        // Ordenação opcional vinda do front
        $allowedSorts = ['id','nome','cpf','rg','email','telefone'];
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
        $enderecos = Endereco::all();
        $profissoes = config('selects.profissoes');
        $estados_civis = config('selects.estados_civis');
        return view('pessoas-fisicas.create', compact('enderecos', 'profissoes', 'estados_civis'));
    }

    /**
     * Salvar Pessoa Física
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Pessoa Física
            'nome'         => 'required|string|max:255',
            'cpf'          => 'nullable|string|max:14|unique:pessoas_fisicas,cpf',
            'rg'           => 'nullable|string|max:14|unique:pessoas_fisicas,rg',
            'estado_civil' => 'nullable|string|max:255',
            'profissao'    => 'nullable|string|max:255',
            'email'        => 'nullable|email|max:255',
            'telefone'     => 'nullable|string|max:15',

            // Endereço
            'logradouro'  => 'nullable|string|max:255',
            'numero'      => 'nullable|string|max:5',
            'bairro'      => 'nullable|string|max:255',
            'cidade'      => 'nullable|string|max:255',
            'estado'      => 'nullable|string|max:2',
            'cep'         => 'nullable|string|max:9',
            'complemento' => 'nullable|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // Cria o endereço (se houver dados)
            $endereco = Endereco::create([
                'logradouro'  => $validated['logradouro'] ?? null,
                'numero'      => $validated['numero'] ?? null,
                'bairro'      => $validated['bairro'] ?? null,
                'cidade'      => $validated['cidade'] ?? null,
                'estado'      => $validated['estado'] ?? null,
                'cep'         => $validated['cep'] ?? null,
                'complemento' => $validated['complemento'] ?? null,
            ]);

            // Cria a Pessoa Física vinculando o Endereço
            $pessoa = PessoaFisica::create([
                'nome'         => $validated['nome'],
                'cpf'          => $validated['cpf'] ?? null,
                'rg'           => $validated['rg'] ?? null,
                'estado_civil' => $validated['estado_civil'] ?? null,
                'profissao'    => $validated['profissao'] ?? null,
                'email'        => $validated['email'] ?? null,
                'telefone'     => $validated['telefone'] ?? null,
                'endereco_id'  => $endereco->id ?? null,
            ]);

            DB::commit();

            // Retorna o registro criado em JSON
            return response()->json([
                'success' => true,
                'data' => $pessoa->load('endereco') // opcional, carrega dados do endereço
            ], 200);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar a Pessoa Física: ' . $e->getMessage()
            ], 500);
        }
    }


    /**
     * Exibir formulário de edição
     */
    public function edit(PessoaFisica $pessoaFisica)
    {
        $enderecos = Endereco::all();
        return view('pessoas-fisicas.edit', compact('pessoaFisica', 'enderecos'));
    }

    /**
     * Atualizar Pessoa Física
     */
    public function update(Request $request, PessoaFisica $pessoaFisica)
    {
        $validated = $request->validate([
            'nome'        => 'required|string|max:255',
            'cpf'         => "required|string|max:20|unique:pessoas_fisicas,cpf,{$pessoaFisica->id}",
            'rg'          => "required|string|max:20|unique:pessoas_fisicas,rg,{$pessoaFisica->id}",
            'email'       => 'nullable|email|max:255',
            'telefone_1'  => 'nullable|string|max:20',
            'telefone_2'  => 'nullable|string|max:20',
            'endereco_id' => 'nullable|exists:enderecos,id',
        ]);

        $pessoaFisica->update($validated);

        return redirect()->route('pessoas-fisicas.index')
                         ->with('success', 'Pessoa Física atualizada com sucesso!');
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
