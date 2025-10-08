@extends('layouts.app')

@section('title', 'Novo Processo')

@section('styles')
<!-- Quill css -->
<link href="{{ asset('assets/vendor/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/vendor/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="mb-3">
    <h4 class="page-title fs-16 fw-semibold mb-0">@yield('title', 'Novo Processo')</h4>
</div>
<div class="card">
    <div class="card-header border-bottom border-dashed d-flex align-items-center">
        <h4 class="header-title">Insira os dados iniciais do Processo...</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="mb-3">
                    <label for="protocolo" class="form-label">Protocolo</label>
                    <input type="text" id="protocolo" class="form-control" name="protocolo">
                </div>
            </div>
            <div class="col-md-2">
                <div class="mb-3">
                    <label for="dataAbertura" class="form-label">Data de Abertura</label>
                    <input type="text" id="dataAbertura" class="form-control" name="data_abertura">
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="imovel" class="form-label">Empresa Responsável</label>
                    <select data-choices data-placeholder="Selecione..." id="imovel" class="form-control" name="imovel_id">
                        <option>Lote X</option>
                        <option>Lote Y</option>
                        <option>Lote Z</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label for="dataAbertura" class="form-label">Representante</label>
                    <input type="text" id="representante" class="form-control" name="representante">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="protocolo" class="form-label">Observações Adicionais</label>
                    <div id="editor" style="height: 180px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Add your dashboard content here -->
@endsection

@section('scripts')
<!-- Quill Editor js -->
<script src="{{ asset('assets/vendor/quill/quill.js') }}"></script>
<script>
var quill = new Quill("#editor", {
    theme: "snow",
    modules: {
        toolbar: [
            ["bold", "italic"],
            [{ list: "bullet" }]
        ]
    }
});
</script>
@endsection