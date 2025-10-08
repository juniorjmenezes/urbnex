@extends('layouts.app')

@section('title', 'Nova Pessoa Jurídica')

@section('styles')
<!-- Quill css -->
<link href="{{ asset('assets/vendor/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="mb-3">
    <h4 class="page-title fs-16 fw-semibold mb-0">@yield('title')</h4>
</div>

<div class="card">
    <div class="card-header border-bottom border-dashed d-flex align-items-center">
        <h4 class="header-title">Insira os dados da Pessoa Jurídica</h4>
    </div>
    <div class="card-body">
        <form action="" method="POST">
            @csrf
            <div class="row">
                <!-- Razão Social -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="razao_social" class="form-label">Razão Social</label>
                        <input type="text" id="razao_social" class="form-control" name="razao_social" required>
                    </div>
                </div>

                <!-- Nome Fantasia -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome_fantasia" class="form-label">Nome Fantasia</label>
                        <input type="text" id="nome_fantasia" class="form-control" name="nome_fantasia">
                    </div>
                </div>

                <!-- CNPJ -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" id="cnpj" class="form-control" name="cnpj" required>
                    </div>
                </div>

                <!-- Telefone -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" id="telefone" class="form-control" name="telefone">
                    </div>
                </div>

                <!-- Email -->
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email">
                    </div>
                </div>

                <!-- Endereço -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Endereço</label>
                        <input type="text" id="endereco" class="form-control" name="endereco" placeholder="Rua 7 de Setembro">
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

                <!-- Bairro, CEP, Cidade, Estado -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" id="bairro" class="form-control" name="bairro">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" id="cep" class="form-control" name="cep">
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

                <!-- Observações -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="observacoes" class="form-label">Observações</label>
                        <div id="editor" style="height: 180px;"></div>
                        <input type="hidden" name="observacoes" id="observacoes">
                    </div>
                </div>
            </div>

            <!-- Botão de salvar -->
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<!-- Quill Editor js -->
<script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
<script>
    var quill = new Quill("#editor", {
        theme: "snow",
        modules: {
            toolbar: [
                ["bold", "italic", "underline"],
                [{ list: "ordered" }, { list: "bullet" }]
            ]
        }
    });

    // Atualiza o campo hidden com o conteúdo do editor antes de enviar
    document.querySelector('form').onsubmit = function() {
        document.getElementById('observacoes').value = quill.root.innerHTML;
    };
</script>
@endsection
