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
                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                    <i class="ki-duotone ki-exit-up fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>
                <!--end::Export-->

                <!--begin::Add user-->
                <button type="button" class="btn btn-sm btn-icon btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                    <i class="ki-duotone ki-plus-circle fs-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button>
                <!--end::Add user-->
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
            <!--begin::Tabs-->
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x mb-6" id="pessoaTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active text-uppercase fw-bold" id="dados-tab" data-bs-toggle="tab" data-bs-target="#informacoes" type="button" role="tab">
                        Informações
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link text-uppercase fw-bold" id="endereco-tab" data-bs-toggle="tab" data-bs-target="#endereco" type="button" role="tab">
                        Endereço
                    </button>
                </li>
            </ul>
            <!--end::Tabs-->
            <!--begin::Tabs content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="informacoes" role="tabpanel">
                    <div class="row mb-4">
                        <div class="col-lg-9">
                            <div class="mb-4">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" id="nome" class="form-control" name="nome" value="{{ old('nome') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                <input type="text" id="data_nascimento" class="form-control" name="data_nascimento" value="{{ old('data_nascimento') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <label for="pais_origem" class="form-label">País de Origem</label>
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
                                <label for="genero" class="form-label">Gênero</label>
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
                                <label for="estado_civil" class="form-label">Estado Civil</label>
                                <select id="estado_civil" class="form-select" name="estado_civil" data-control="select2" data-placeholder="Escolha..." autocomplete="off">
                                    <option value="">Escolha...</option>
                                    <!-- Opções serão carregadas via JS -->
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="profissao" class="form-label">Profissão</label>
                                <select id="profissao" name="profissao" class="form-select" data-control="select2" data-placeholder="Escolha..." autocomplete="off">
                                    <option value="">Escolha...</option>
                                    <!-- Opções serão carregadas via JS -->
                                </select>
                            </div>
                        </div>                        
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="cpf_cin" class="form-label">CPF/CIN</label>
                                <input type="text" id="cpf_cin" class="form-control" name="cpf_cin" data-toggle="input-mask" data-mask-format="999.999.999-99" value="{{ old('cpf_cin') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="rg" class="form-label">RG</label>
                                <input type="text" id="rg" class="form-control" name="rg" value="{{ old('rg') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="rne_crnm" class="form-label">RNE/CRNM</label>
                                <input type="text" id="rne_crnm" class="form-control" name="rne_crnm" value="{{ old('rne_crnm') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="cnh" class="form-label">CNH</label>
                                <input type="text" id="cnh" class="form-control" name="cnh" value="{{ old('cnh') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="passaporte" class="form-label">Passaporte</label>
                                <input type="text" id="passaporte" class="form-control" name="passaporte" value="{{ old('passaporte') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="telefone_1" class="form-label">Telefone 1</label>
                                <input type="text" id="telefone_1" class="form-control" name="telefone_1" value="{{ old('telefone_1') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="telefone_2" class="form-label">Telefone 2</label>
                                <input type="text" id="telefone_2" class="form-control" name="telefone_2" value="{{ old('telefone_2') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Tab pane-->
                <!--begin::Tab pane-->
                <div class="tab-pane" id="endereco" role="tabpanel">
                    <div class="row mb-4">
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" id="cep" class="form-control" name="cep" data-toggle="input-mask" data-mask-format="99999-999" value="{{ old('cep') }}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-4">
                                <label for="logradouro" class="form-label">Logradouro</label>
                                <input type="text" id="logradouro" class="form-control" name="logradouro" placeholder="Ex.: Rua 7 de Setembro" value="{{ old('logradouro') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" id="numero" class="form-control" name="numero" value="{{ old('numero') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" id="complemento" class="form-control" name="complemento" value="{{ old('complemento') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" id="bairro" class="form-control" name="bairro" value="{{ old('bairro') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" id="cidade" class="form-control" name="cidade" value="{{ old('cidade') }}">
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="mb-4">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" id="estado" class="form-control" name="estado" value="{{ old('estado') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Tab pane-->
                <!--begin::Button-->
                <button type="submit" class="btn btn-primary w-100">Salvar</button>
                <!--end::Button-->
            </div>
            <!--end::Tabs content-->
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