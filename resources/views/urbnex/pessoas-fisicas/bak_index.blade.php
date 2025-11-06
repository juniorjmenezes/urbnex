@extends('layouts.app_internal')

@section('title', 'Pessoas Físicas')

@section('styles')
    <link href="{{ asset('assets/vendor/gridjs/mermaid.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="card">
    <div class="card-header border-bottom border-dashed d-flex align-items-center">
        <h4 class="header-title">Pessoas Físicas</h4>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between mb-3 flex-column flex-lg-row">
            <div id="toolbar" class="w-lg-50">
                <button type="button" class="btn btn-sm btn-icon btn-ghost-light text-dark rounded-circle" id="btn-refresh" data-bs-toggle="tooltip" data-bs-html="true" data-bs-trigger="hover" data-bs-placement="top" data-bs-title="Voltar" onClick="window.location.href='{{ url()->previous() }}'">
                    <i class="ri-arrow-left-line fs-18"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-ghost-light text-dark rounded-circle" id="btn-refresh" data-bs-toggle="tooltip" data-bs-html="true" data-bs-trigger="hover" data-bs-placement="top" data-bs-title="Atualizar">
                    <i class="ri-restart-line fs-18"></i>
                </button>
                <button type="button" class="btn btn-sm btn-icon btn-ghost-light text-dark rounded-circle btn-add" data-bs-toggle="tooltip" data-bs-html="true" data-bs-trigger="hover" data-bs-placement="top" data-bs-title="Novo" onClick="window.location.href='{{ route('pessoasFisicas.create') }}'">
                    <i class="ri-add-circle-line fs-18"></i>
                </button>
            </div>
            <input type="text" id="search-pessoas" class="form-control rounded-pill w-lg-50" placeholder="Buscar...">
        </div>
        <hr>
        <div id="table-pessoas"></div>
    </div>
</div>
@include('pessoas-fisicas.create-modal')
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/gridjs/gridjs.umd.js') }}"></script>
<script src="{{ asset('assets/js/helpers/gridjs-helper.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Configuração específica para pessoas físicas
    const pessoasGrid = new GridHelper({
        container: document.getElementById('table-pessoas'),
        apiUrl: '/api/pessoas-fisicas',
        searchInput: document.getElementById('search-pessoas'),
        pageSize: 12,
        columns: [
            {
                id: 'id',
                name: 'ID',
                hidden: true
            },
            {
                id: 'nome',
                name: 'Nome',
                formatter: (cell) => gridjs.html(`<span class="text-dark">${cell}</span>`)
            },
            {
                id: 'cpf_cin',
                name: 'CPF/CIN',
                formatter: (cell) => gridjs.html(`<span class="text-dark">${cell ?? '-'}</span>`)
            },
            {
                id: 'email',
                name: 'E-mail',
                formatter: (cell) => gridjs.html(`<span class="text-dark">${cell ?? '-'}</span>`)
            },
            {
                id: 'acoes',
                name: '',
                width: '5%',
                sort: false,
                formatter: (_, row) => {
                // Aqui você define seus botões específicos para pessoas físicas
                const pessoa = row.cells.reduce((obj, cell, index) => {
                    const columnId = pessoasGrid.columns[index]?.id;
                    if (columnId) obj[columnId] = cell.data;
                    return obj;
                }, {});

                return gridjs.html(`
                    <div class="dropdown flex-shrink-0 text-muted">
                        <a href="#" class="dropdown-toggle drop-arrow-none fs-20 link-reset" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-2-fill"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <button class="dropdown-item btn-editar" onclick="window.location.href = '/pessoas-fisicas/${pessoa.id}/edit'">
                            <i class="ri-edit-box-line me-1"></i> Editar
                            </button>
                            <a href="#" class="dropdown-item" onclick="verPessoa('${pessoa.id}')">
                            <i class="ri-eye-line me-1"></i> Visualizar
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-danger" onclick="excluirPessoa('${pessoa.id}', '${pessoa.nome}')">
                            <i class="ri-delete-bin-line me-1"></i> Excluir
                            </a>
                        </div>
                    </div>
                `);
                }
            }
        ]
    });

    // Torna disponível globalmente
    window.pessoasGrid = pessoasGrid;
    
    document.getElementById('btn-refresh').addEventListener('click', function() {
        // Limpa o input de busca
        const searchInput = document.getElementById('search-pessoas');
        searchInput.value = '';
        
        // Zera o termo de busca no GridHelper
        if (window.pessoasGrid) {
            window.pessoasGrid.currentSearch = '';
            window.pessoasGrid.refresh();
        }
    });
});
</script>
@endsection
