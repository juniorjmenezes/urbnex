<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\PessoaJuridica;
use App\Models\Endereco;

class PessoaJuridicaController extends Controller
{
    /**
     * Exibir a lista de Pessoas Jurídicas
     */
    public function index()
    {
        $pessoasJuridicas = PessoaJuridica::with('endereco')->paginate(10);
        return view('pessoas-juridicas.index', compact('pessoasJuridicas'));
    }

    /**
     * Exibir formulário de criação
     */
    public function create()
    {
        $enderecos = Endereco::all();
        return view('pessoas-juridicas.create', compact('enderecos'));
    }

    /**
     * Salvar Pessoa Jurídica
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // Pessoa Jurídica
            'razao_social'   => 'required|string|max:255',
            'nome_fantasia'  => 'nullable|string|max:255',
            'cnpj'           => 'required|string|max:18|unique:pessoas_juridicas,cnpj',
            'email'          => 'nullable|email|max:255',
            'telefone_1'     => 'nullable|string|max:15',
            'telefone_2'     => 'nullable|string|max:15',
    
            // Endereço
            'logradouro'     => 'nullable|string|max:255',
            'numero'         => 'nullable|string|max:5',
            'bairro'         => 'nullable|string|max:255',
            'cidade'         => 'nullable|string|max:255',
            'estado'         => 'nullable|string|max:2',
            'cep'            => 'nullable|string|max:9',
            'complemento'    => 'nullable|string|max:255',
        ]);
    
        try {
            DB::beginTransaction();
    
            // Cria o endereço (se houver dados)
            $endereco = Endereco::create([
                'logradouro'    => $validated['logradouro'] ?? null,
                'numero'        => $validated['numero'] ?? null,
                'bairro'        => $validated['bairro'] ?? null,
                'cidade'        => $validated['cidade'] ?? null,
                'estado'        => $validated['estado'] ?? null,
                'cep'           => $validated['cep'] ?? null,
                'complemento'   => $validated['complemento'] ?? null,
            ]);
    
            // Cria a pessoa jurídica vinculando o endereço
            PessoaJuridica::create([
                'razao_social'  => $validated['razao_social'],
                'nome_fantasia' => $validated['nome_fantasia'] ?? null,
                'cnpj'          => $validated['cnpj'],
                'email'         => $validated['email'] ?? null,
                'telefone_1'    => $validated['telefone_1'],
                'telefone_2'    => $validated['telefone_2'] ?? null,
                'endereco_id'   => $endereco->id ?? null,
            ]);
    
            DB::commit();
    
            return redirect()->route('pessoasJuridicas.index')->with('success', 'Pessoa Jurídica criada com sucesso!');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Erro ao criar a Pessoa Jurídica: ' . $e->getMessage())->withInput();
        }
    }
    

    /**
     * Exibir formulário de edição
     */
    public function edit(PessoaJuridica $pessoaJuridica)
    {
        $enderecos = Endereco::all();
        return view('pessoas-juridicas.edit', compact('pessoaJuridica', 'enderecos'));
    }

    /**
     * Atualizar Pessoa Jurídica
     */
    public function update(Request $request, PessoaJuridica $pessoaJuridica)
    {
        $validated = $request->validate([
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'cnpj' => "required|string|max:20|unique:pessoas_juridicas,cnpj,{$pessoaJuridica->id}",
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'endereco_id' => 'nullable|exists:enderecos,id',
        ]);

        $pessoaJuridica->update($validated);

        return redirect()->route('pessoas-juridicas.index')
                         ->with('success', 'Pessoa Jurídica atualizada com sucesso!');
    }

    /**
     * Deletar Pessoa Jurídica
     */
    public function destroy(PessoaJuridica $pessoaJuridica)
    {
        $pessoaJuridica->delete();

        return redirect()->route('pessoas-juridicas.index')
                         ->with('success', 'Pessoa Jurídica removida com sucesso!');
    }
}
