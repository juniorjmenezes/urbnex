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
        <form action="{{ route('pessoasFisicas.update', $pessoaFisica) }}" method="POST" id="formUpdatePessoaFisica">
            @csrf
            @method('PUT')
            <div class="row">
                <!-- Dados pessoais -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" id="nome" class="form-control" name="nome" value="{{ old('nome', $pessoaFisica->nome ) }}">
                    </div>
                </div>
                
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="genero" class="form-label">Gênero</label>
                        <select id="genero" name="genero" data-placeholder="Escolha...">
                            <option value="">Escolha...</option>
                            <option value="m" {{ old('genero', $pessoaFisica->genero) == 'm' ? 'selected' : '' }}>
                                Masculino
                            </option>
                            <option value="f" {{ old('genero', $pessoaFisica->genero) == 'f' ? 'selected' : '' }}>
                                Feminino
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3">
                    <label for="pais_origem" class="form-label">País de Origem</label>
                    <select id="pais_origem" name="pais_origem" data-placeholder="Escolha...">
                        <option value="">Escolha...</option>
                        @foreach ($paisesOrigem as $paisOrigem)
                            <option value="{{ $paisOrigem['value'] }}" data-flag="{{ $paisOrigem['flag'] }}"         @selected(old('pais_origem', $pessoaFisica->pais_origem) == $paisOrigem['value'])> 
                                {{ $paisOrigem['text'] }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cpf_cin" class="form-label">CPF/CIN</label>
                        <input type="text" id="cpf_cin" class="form-control" name="cpf_cin" data-toggle="input-mask" data-mask-format="999.999.999-99" value="{{ old('cpf_cin', $pessoaFisica->cpf_cin) }}">
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
                        <label for="rne_crnm" class="form-label">RNE/CRNM</label>
                        <input type="text" id="rne_crnm" class="form-control" name="rne_crnm" value="{{ old('rne_crnm', $pessoaFisica->rne_crnm) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cnh" class="form-label">CNH</label>
                        <input type="text" id="cnh" class="form-control" name="cnh" value="{{ old('cnh', $pessoaFisica->cnh) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="passaporte" class="form-label">Passaporte</label>
                        <input type="text" id="passaporte" class="form-control" name="passaporte" value="{{ old('passaporte', $pessoaFisica->passaporte) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="estado_civil" class="form-label">Estado Civil</label>
                        <select id="estado_civil" name="estado_civil" data-placeholder="Escolha..." data-old="{{ old('estado_civil', $pessoaFisica->estado_civil ?? '') }}" autocomplete="off">
                            <option value="">Escolha...</option>
                            <!-- Opções serão carregadas via JS -->
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="profissao" class="form-label">Profissão</label>
                        <select id="profissao" name="profissao" data-placeholder="Escolha..." data-old="{{ old('estado_civil', $pessoaFisica->profissao ?? '') }}" autocomplete="off">
                            <option value="">Escolha...</option>
                            <!-- Opções serão carregadas via JS -->
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" id="telefone" class="form-control" name="telefone" data-toggle="input-mask" data-mask-format="(00) 00000-0000" value="{{ old('telefone', $pessoaFisica->telefone) }}">
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
                        <input type="text" id="cep" class="form-control" name="cep" data-toggle="input-mask" data-mask-format="99999-999" value="{{ old('cep', $pessoaFisica->endereco->cep) }}">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" id="logradouro" class="form-control" name="logradouro" placeholder="Ex.: Rua 7 de Setembro" value="{{ old('logradouro', $pessoaFisica->endereco->logradouro) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" id="numero" class="form-control" name="numero" value="{{ old('numero', $pessoaFisica->endereco->numero) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" id="complemento" class="form-control" name="complemento" value="{{ old('complemento', $pessoaFisica->endereco->complemento) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" id="bairro" class="form-control" name="bairro" value="{{ old('bairro', $pessoaFisica->endereco->bairro) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" id="cidade" class="form-control" name="cidade" value="{{ old('cidade', $pessoaFisica->endereco->cidade) }}">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <input type="text" id="estado" class="form-control" name="estado" value="{{ old('estado', $pessoaFisica->endereco->estado) }}">
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