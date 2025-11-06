@extends('layouts.app')

@section('title', 'Processos')

@section('content')
<div class="mb-3">
    <h4 class="page-title fs-20 fw-semibold mb-0">@yield('title', 'Processos')</h4>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="processo">Processo</label>
                    <input type="text" class="form-control" id="processo" placeholder="Processo">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="processo">Processo</label>
                    <input type="text" class="form-control" id="processo" placeholder="Processo">
                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Add your dashboard content here -->
@endsection