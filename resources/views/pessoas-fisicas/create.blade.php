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
        <form action="{{ route('pessoasFisicas.store') }}" method="POST" id="formStorePessoaFisica">
            @csrf
            <!-- Tabs -->
            <ul class="nav nav-tabs mb-3" id="pessoaTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="dados-tab" data-bs-toggle="tab" data-bs-target="#informacoes" type="button" role="tab">Informações</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="documentos-tab" data-bs-toggle="tab" data-bs-target="#documentos" type="button" role="tab">Documentos</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="contato-tab" data-bs-toggle="tab" data-bs-target="#contato" type="button" role="tab">Contato</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="endereco-tab" data-bs-toggle="tab" data-bs-target="#endereco" type="button" role="tab">Endereço</button>
                </li>
            </ul>

            <!-- Tabs content -->
            <div class="tab-content">
                <!-- Dados pessoais -->
                <div class="tab-pane fade show active" id="informacoes" role="tabpanel">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" id="nome" class="form-control" name="nome" value="{{ old('nome') }}">
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <label for="pais_origem" class="form-label">País de Origem</label>
                            <select id="pais_origem" name="pais_origem" data-placeholder="Escolha...">
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

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" id="data_nascimento" class="form-control" name="data_nascimento" value="{{ old('data_nascimento') }}">
                            </div>
                        </div>
                        
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="genero" class="form-label">Gênero</label>
                                <select id="genero" name="genero" data-placeholder="Escolha...">
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

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="estado_civil" class="form-label">Estado Civil</label>
                                <select id="estado_civil" name="estado_civil" data-placeholder="Escolha..." autocomplete="off">
                                    <option value="">Escolha...</option>
                                    <!-- Opções serão carregadas via JS -->
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="profissao" class="form-label">Profissão</label>
                                <select id="profissao" name="profissao" data-placeholder="Escolha..." autocomplete="off" select>
                                    <option value="">Escolha...</option>
                                    <!-- Opções serão carregadas via JS -->
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="cpf_cin" class="form-label">CPF/CIN</label>
                                <input type="text" id="cpf_cin" class="form-control" name="cpf_cin" data-toggle="input-mask" data-mask-format="999.999.999-99" value="{{ old('cpf_cin') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="rg" class="form-label">RG</label>
                                <input type="text" id="rg" class="form-control" name="rg" value="{{ old('rg') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="rne_crnm" class="form-label">RNE/CRNM</label>
                                <input type="text" id="rne_crnm" class="form-control" name="rne_crnm" value="{{ old('rne_crnm') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="cnh" class="form-label">CNH</label>
                                <input type="text" id="cnh" class="form-control" name="cnh" value="{{ old('cnh') }}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="passaporte" class="form-label">Passaporte</label>
                                <input type="text" id="passaporte" class="form-control" name="passaporte" value="{{ old('passaporte') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Endereço -->
                <div class="tab-pane" id="endereco" role="tabpanel">
                    <div class="row">
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
                </div>
            </div>
            <footer class="bg-white border-todp py-2 position-fixed bottom-0 start-0 end-0 shadow-sm text-end pe-3">
                <button type="button" class="btn btn-light me-2" onclick="window.history.back()">
                    <i class="ri-arrow-left-line me-1"></i>Voltar</button>
                <button type="submit" class="btn btn-primary">
                    <i class="ri-save-line me-1"></i>Salvar
                </button>
            </footer>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- InputMask -->
<script src="{{ asset('assets/js/components/form-inputmask.js') }}"></script>
<!-- JQuery Validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.min.js"></script>
<!-- Helpers -->
<script src="{{ asset('assets/js/helpers/tom-select-helper.js') }}"></script>
<script src="{{ asset('assets/js/helpers/ajax-form-helper.js') }}"></script>

<!-- Page JS -->
<script>
    const ESTADOS_CIVIS_MASCULINOS = @json($estadosCivisMasculinos);
    const ESTADOS_CIVIS_FEMININOS  = @json($estadosCivisFemininos);
    const PROFISSOES_MASCULINAS    = @json($profissoesMasculinas);
    const PROFISSOES_FEMININAS     = @json($profissoesFemininas);
</script>
<script src="{{ asset('assets/js/pages/pessoa-fisica-actions.js') }}"></script>
@endsection