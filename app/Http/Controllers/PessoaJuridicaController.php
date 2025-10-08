<?php

namespace App\Http\Controllers;

use App\Models\PessoaJuridica;
use App\Models\Endereco;
use Illuminate\Http\Request;

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
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'nullable|string|max:255',
            'cnpj' => 'required|string|max:20|unique:pessoas_juridicas,cnpj',
            'email' => 'nullable|email|max:255',
            'telefone' => 'nullable|string|max:20',
            'endereco_id' => 'nullable|exists:enderecos,id',
        ]);

        PessoaJuridica::create($validated);

        return redirect()->route('pessoas-juridicas.index')
                         ->with('success', 'Pessoa Jurídica criada com sucesso!');
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
