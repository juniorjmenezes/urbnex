@extends('layouts.app')

@section('title', 'Nova Pessoa Física')

@section('content')
<div class="mb-3">
    <h4 class="page-title fs-16 fw-semibold mb-0">@yield('title')</h4>
</div>

<div class="card">
    <div class="card-header border-bottom border-dashed d-flex align-items-center">
        <h4 class="header-title">Insira os dados da Pessoa Física</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('pessoasFisicas.update', $pessoaFisica->id) }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" id="nome" class="form-control" name="nome" value="{{ old('nome', $pessoaFisica->nome) }}" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" id="cpf" class="form-control" name="cpf"  data-toggle="input-mask" data-mask-format="999.999.999-99" value="{{ old('cpf', $pessoaFisica->cpf) }}" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="rg" class="form-label">RG</label>
                        <input type="text" id="rg" class="form-control" name="rg" value="{{ old('rg', $pessoaFisica->rg) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="estado_civil" class="form-label">Estado Civil</label>
                        <select id="estado_civil" name="estado_civil" class="form-control" data-choices>
                            <option value="">Selecione...</option>
                            <option value="Solteiro" {{ old('estado_civil', $pessoaFisica->estado_civil) == 'Solteiro' ? 'selected' : '' }}>Solteiro</option>
                            <option value="Casado" {{ old('estado_civil', $pessoaFisica->estado_civil) == 'Casado' ? 'selected' : '' }}>Casado</option>
                            <option value="Separado" {{ old('estado_civil', $pessoaFisica->estado_civil) == 'Separado' ? 'selected' : '' }}>Separado</option>
                            <option value="Divorciado" {{ old('estado_civil', $pessoaFisica->estado_civil) == 'Divorciado' ? 'selected' : '' }}>Divorciado</option>
                            <option value="Viúvo" {{ old('estado_civil', $pessoaFisica->estado_civil) == 'Viúvo' ? 'selected' : '' }}>Viúvo</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="profissao" class="form-label">Profissão</label>
                        <select id="profissao" name="profissao" class="form-control" data-choices>
                            <option value="">Selecione...</option>
                            @foreach ($profissoes as $profissao)
                                <option value="{{ $profissao }}" {{ old('profissao', $pessoaFisica->profissao) == $profissao ? 'selected' : '' }}>
                                    {{ $profissao }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" id="telefone" class="form-control" name="telefone" data-toggle="input-mask" data-mask-format="(00) 00000-0000" value="{{ old('telefone', $pessoaFisica->telefone) }}" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email', $pessoaFisica->email) }}">
                    </div>
                </div>

                <!-- Endereço -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" id="cep" class="form-control" name="cep" data-toggle="input-mask" data-mask-format="99999-999" placeholder="Ex.: 12345-678" value="{{ old('cep', $pessoaFisica->cep) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" id="logradouro" class="form-control" name="logradouro" placeholder="Ex.: Rua 7 de Setembro" value="{{ old('logradouro', $pessoaFisica->logradouro) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" id="numero" class="form-control" name="numero" value="{{ old('numero', $pessoaFisica->numero) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" id="complemento" class="form-control" name="complemento" value="{{ old('complemento', $pessoaFisica->complemento) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" id="bairro" class="form-control" name="bairro" value="{{ old('bairro', $pessoaFisica->bairro) }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" id="cidade" class="form-control" name="cidade" value="{{ old('cidade', $pessoaFisica->cidade) }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" id="estado" class="form-control" name="estado" data-toggle="input-mask" data-mask-format="AA" placeholder="Ex.: CE" value="{{ old('estado', $pessoaFisica->estado) }}">
                    </div>
                </div>
            </div>

            <!-- Botão de salvar -->
            <button type="submit" class="btn btn-primary text-uppercase">Salvar</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/components/form-inputmask.js') }}"></script>
@endsection
