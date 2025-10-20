@extends('layouts.app')

@section('title', 'Nova Pessoa Física')

@section('styles')
    <!-- Flag Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css" />
@endsection


@section('content')
<div class="card">
    <div class="card-header border-bottom border-dashed d-flex align-items-center">
        <h4 class="header-title">Nova Pessoa Física</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('pessoasFisicas.store') }}" method="POST" id="formPessoaFisica">
            @csrf
            <div class="row">
                <!-- Dados de Origem -->
                <div class="col-lg-3">
                    <label for="nacionalidade" class="form-label">Nacionalidade</label>
                    <select id="nacionalidade" name="nacionalidade" data-placeholder="Escolha...">
                        <option value="">Escolha...</option>
                            @foreach ($nacionalidades as $nacionalidade)
                                <option value="{{ $nacionalidade['value'] }}" data-flag="{{ $nacionalidade['flag'] }}" {{ old('nacionalidade') == $nacionalidade['value'] ? 'selected' : '' }}>
                                    {{ $nacionalidade['text'] }}
                                </option>
                            @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="passaporte" class="form-label">Passaporte</label>
                        <input type="text" id="passaporte" class="form-control" name="passaporte" value="{{ old('passaporte') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Dados pessoais -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" id="nome" class="form-control" name="nome" value="{{ old('nome') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF/CIN</label>
                        <input type="text" id="cpf" class="form-control" name="cpf" data-toggle="input-mask" data-mask-format="999.999.999-99" value="{{ old('cpf') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="rg" class="form-label">RG/CNRM</label>
                        <input type="text" id="rg" class="form-control" name="rg" value="{{ old('rg') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="estado_civil" class="form-label">Estado Civil</label>
                        <select id="estado_civil" name="estado_civil" data-placeholder="Escolha..." autocomplete="off">
                            <option value="">Escolha...</option>
                            @foreach ($estados_civis as $estado_civil)
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
                        <select id="profissao" name="profissao" data-placeholder="Escolha..." autocomplete="off">
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
                        <input type="text" id="telefone" class="form-control" name="telefone" data-toggle="input-mask" data-mask-format="(00) 00000-0000" value="{{ old('telefone') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>

                <!-- Endereço -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" id="cep" class="form-control" name="cep" data-toggle="input-mask" data-mask-format="99999-999" value="{{ old('cep') }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" id="logradouro" class="form-control" name="logradouro" placeholder="Ex.: Rua 7 de Setembro" value="{{ old('logradouro') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" id="numero" class="form-control" name="numero" value="{{ old('numero') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" id="complemento" class="form-control" name="complemento" value="{{ old('complemento') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" id="bairro" class="form-control" name="bairro" value="{{ old('bairro') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" id="cidade" class="form-control" name="cidade" value="{{ old('cidade') }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" id="estado" class="form-control" name="estado" value="{{ old('estado') }}">
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary text-uppercase">
                <i class="ri-save-line me-1"></i>Salvar
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/js/components/form-inputmask.js') }}"></script>
<script src="{{ asset('assets/js/helpers/tom-select-helper.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
<script src="{{ asset('assets/js/helpers/ajax-form-helper.js') }}"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // Inicializa TomSelect
    initTomSelect(["#estado_civil", "#profissao"]);

    new TomSelect("#nacionalidade", {
        render: {
            option: function(data, escape) {
                return `<div>
                    <span class="fi fi-${escape(data.flag)} me-2"></span> ${escape(data.text)}
                </div>`;
            },
            item: function(data, escape) {
                return `<div>
                    <span class="fi fi-${escape(data.flag)} me-1"></span> ${escape(data.text)}
                </div>`;
            }
        }
    });

   setupAjaxForm("#formPessoaFisica", {
        rules: {
            nome:         { required: true, maxlength: 255 },
            cpf:          { required: true, cpfBR: true },
            rg:           { maxlength: 14 },
            estado_civil: { maxlength: 255 },
            profissao:    { maxlength: 255 },
            email:        { email: true, maxlength: 255 },
            telefone:     { required: true, maxlength: 15 }
        },
        messages: {
            nome:     "Informe o nome completo.",
            cpf:      "Informe um CPF válido.",
            telefone: "Informe o telefone.",
            email:    "Informe um e-mail válido."
        }
    });
});
</script>
@endsection
