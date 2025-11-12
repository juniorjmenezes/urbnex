@extends('layouts.app_internal')

@section('title', 'Nova Pessoa Física')

@section('styles')
    <!-- Flag Icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flag-icons/css/flag-icons.min.css" />
@endsection

@section('content')
<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header">
        <div class="d-flex align-items-center menu-heading text-uppercase">Nova Pessoa Física</div>
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                <!--begin::Export-->
                <a href="{{ url()->previous() }}" class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" title="Voltar">
                    <i class="ki-outline ki-arrow-left fs-2"></i>
                </a>
                <!--end::Export-->
                <!--begin::Export-->
                <a href="{{ route('urbnex.pessoasFisicas.index') }}" class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end" title="Pessoas Físicas">
                    <i class="ki-outline ki-folder fs-2"></i>
                </a>
                <!--end::Export-->
            </div>
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Form-->
        <form action="{{ route('urbnex.pessoasFisicas.store') }}" method="POST" id="formStorePessoaFisica">
            @csrf

            <div class="row">
                <div class="col-lg-9">
                    <div class="mb-4">
                        <label for="nome" class="text-gray-700 mb-2">Nome Completo</label>
                        <input type="text" id="nome" class="form-control" name="nome" value="{{ old('nome') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="data_nascimento" class="text-gray-700 mb-2">Data de Nascimento</label>
                        <input type="text" id="data_nascimento" class="form-control" name="data_nascimento" value="{{ old('data_nascimento') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <label for="pais_origem" class="text-gray-700 mb-2">País de Origem</label>
                    <select id="pais_origem" class="form-select" name="pais_origem" data-control="select2" data-placeholder="Escolha...">
                        <option value="">Escolha...</option>
                        @foreach ($paisesOrigem as $paisOrigem)
                            <option 
                                value="{{ $paisOrigem['value'] }}" 
                                data-flag="{{ $paisOrigem['flag'] }}" 
                                {{ (old('pais_origem', 'Brasil') == $paisOrigem['value']) ? 'selected' : '' }}
                            >
                                {{ $paisOrigem['text'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="genero" class="text-gray-700 mb-2">Gênero</label>
                        <select id="genero" name="genero" class="form-select" data-control="select2" data-placeholder="Escolha...">
                        <option value="">Escolha...</option>
                            <option value="m" {{ old('genero') == 'm' ? 'selected' : '' }}>
                                Masculino
                            </option>
                            <option value="f" {{ old('genero') == 'f' ? 'selected' : '' }}>
                                Feminino
                            </option>
                    </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="estado_civil" class="text-gray-700 mb-2">Estado Civil</label>
                        <select id="estado_civil" class="form-select" name="estado_civil" data-control="select2" data-placeholder="Escolha..." autocomplete="off">
                            <option value="">Escolha...</option>
                            <!-- Opções serão carregadas via JS -->
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="profissao" class="text-gray-700 mb-2">Profissão</label>
                        <select id="profissao" name="profissao" class="form-select" data-control="select2" data-placeholder="Escolha..." autocomplete="off">
                            <option value="">Escolha...</option>
                            <!-- Opções serão carregadas via JS -->
                        </select>
                    </div>
                </div>                        
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="cpf_cin" class="text-gray-700 mb-2">CPF/CIN</label>
                        <input type="text" id="cpf_cin" class="form-control" name="cpf_cin" data-toggle="input-mask" data-mask-format="999.999.999-99" value="{{ old('cpf_cin') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="rg" class="text-gray-700 mb-2">RG</label>
                        <input type="text" id="rg" class="form-control" name="rg" value="{{ old('rg') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="rne_crnm" class="text-gray-700 mb-2">RNE/CRNM</label>
                        <input type="text" id="rne_crnm" class="form-control" name="rne_crnm" value="{{ old('rne_crnm') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="cnh" class="text-gray-700 mb-2">CNH</label>
                        <input type="text" id="cnh" class="form-control" name="cnh" value="{{ old('cnh') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="passaporte" class="text-gray-700 mb-2">Passaporte</label>
                        <input type="text" id="passaporte" class="form-control" name="passaporte" value="{{ old('passaporte') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="telefone_1" class="text-gray-700 mb-2">Telefone 1</label>
                        <input type="text" id="telefone_1" class="form-control" name="telefone_1" data-mask="telefone" value="{{ old('telefone_1') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="telefone_2" class="text-gray-700 mb-2">Telefone 2</label>
                        <input type="text" id="telefone_2" class="form-control" name="telefone_2" data-mask="telefone" value="{{ old('telefone_2') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label for="email" class="text-gray-700 mb-2">Email</label>
                        <input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="cep" class="text-gray-700 mb-2">CEP</label>
                        <input type="text" id="cep" class="form-control" name="cep" data-toggle="input-mask" data-mask-format="99999-999" value="{{ old('cep') }}">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-4">
                        <label for="logradouro" class="text-gray-700 mb-2">Logradouro</label>
                        <input type="text" id="logradouro" class="form-control" name="logradouro" placeholder="Ex.: Rua 7 de Setembro" value="{{ old('logradouro') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="numero" class="text-gray-700 mb-2">Número</label>
                        <input type="text" id="numero" class="form-control" name="numero" value="{{ old('numero') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="complemento" class="text-gray-700 mb-2">Complemento</label>
                        <input type="text" id="complemento" class="form-control" name="complemento" value="{{ old('complemento') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="bairro" class="text-gray-700 mb-2">Bairro</label>
                        <input type="text" id="bairro" class="form-control" name="bairro" value="{{ old('bairro') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="cidade" class="text-gray-700 mb-2">Cidade</label>
                        <input type="text" id="cidade" class="form-control" name="cidade" value="{{ old('cidade') }}">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="mb-4">
                        <label for="estado" class="text-gray-700 mb-2">Estado</label>
                        <input type="text" id="estado" class="form-control" name="estado" value="{{ old('estado') }}">
                    </div>
                </div>
            </div>
            <!--begin::Button-->
            <button type="submit" class="btn btn-primary w-100 mt-4">Salvar</button>
            <!--end::Button-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->

@endsection

@push('js')
<!-- JQuery Validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
<!-- Flags -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css" rel="stylesheet">
<!-- Helpers -->
<script src="{{ asset('assets/js/helpers/ajax-form-helper.js') }}"></script>
<script>
    const ESTADOS_CIVIS_MASCULINOS = @json($estadosCivisMasculinos);
    const ESTADOS_CIVIS_FEMININOS  = @json($estadosCivisFemininos);
    const PROFISSOES_MASCULINAS    = @json($profissoesMasculinas);
    const PROFISSOES_FEMININAS     = @json($profissoesFemininas);
</script>
<!-- Page JS -->
<script src="{{ asset('assets/js/pages/pessoa-fisica-actions.js') }}"></script>
@endpush