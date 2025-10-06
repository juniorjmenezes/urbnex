@extends('layouts.app')

@section('title', 'Novo Processo')

@section('content')
<div class="mb-3">
    <h4 class="page-title fs-20 fw-semibold mb-0">@yield('title', 'Novo Processo')</h4>
</div>
<div class="card">
    <div class="card-header border-bottom border-dashed d-flex align-items-center">
        <h4 class="header-title">Insira os dados do Processo...</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="simpleinput" class="form-label">Text</label>
                    <input type="text" id="simpleinput" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="simpleinput" class="form-label">Text</label>
                    <input type="text" id="simpleinput" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Add your dashboard content here -->
@endsection