@extends('layouts.app')

@section('title', 'Nova Pessoa Física')

@section('content')
<div class="card">
    <div class="card-header border-bottom border-dashed d-flex align-items-center">
        <h4 class="header-title">Nova Pessoa Física</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('pessoasFisicas.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" id="nome" class="form-control" name="nome" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" id="cpf" class="form-control" name="cpf"  data-toggle="input-mask" data-mask-format="999.999.999-99">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="rg" class="form-label">RG</label>
                        <input type="text" id="rg" class="form-control" name="rg">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="estado_civil" class="form-label">Estado Civil</label>
                        <select id="estado_civil" name="estado_civil" data-placeholder="Escolha..." autocomplete="off">
                            @foreach ($estados_civis as $estado_civil)
                                <option></option>
                                <option value="{{ $estado_civil }}" {{ old('estado_civil') == $estado_civil ? 'selected' : '' }}>
                                    {{ $estado_civil }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="profissao" class="form-label">Profissão</label>
                        <select id="profissao" class="form-select" name="profissao" data-placeholder="Escolha..." autocomplete="off">
                            <option value="">Escolha...</option>
                            @foreach ($profissoes as $profissao)
                                <option value="{{ $profissao }}" {{ old('profissao') == $profissao ? 'selected' : '' }}>
                                    {{ $profissao }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" id="telefone" class="form-control" name="telefone" data-toggle="input-mask" data-mask-format="(00) 00000-0000">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email">
                    </div>
                </div>

                <!-- Endereço -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" id="cep" class="form-control" name="cep" data-toggle="input-mask" data-mask-format="99999-999">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" id="logradouro" class="form-control" name="logradouro" placeholder="Ex.: Rua 7 de Setembro">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" id="numero" class="form-control" name="numero">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" id="complemento" class="form-control" name="complemento">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" id="bairro" class="form-control" name="bairro">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" id="cidade" class="form-control" name="cidade">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" id="estado" class="form-control" name="estado">
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
    <script>
        

        new TomSelect("#estado_civil", {
            create: false,
            createOnBlur: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });
        new TomSelect("#profissao", {
            create: false,
            createOnBlur: false,
            sortField: {
                field: "text",
                direction: "asc"
            }
        });


    </script>
@endsection
