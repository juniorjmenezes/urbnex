@extends('layouts.app')

@section('title', 'Processos')

@section('styles')
    <link href="{{ asset('assets/vendor/gridjs/mermaid.min.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="mb-3">
    <h4 class="page-title fs-20 fw-semibold mb-0">@yield('title', 'Processos')</h4>
</div>
<div class="card">
    <div class="card-body">
        <input type="text" id="custom-search" class="form-control mb-3" placeholder="Buscar...">
        <div id="table-pessoas"></div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/vendor/gridjs/gridjs.umd.js') }}"></script>
<script>
    const container = document.getElementById("table-pessoas");
    const searchInput = document.getElementById("custom-search");
    let currentSearch = '';
    let grid;

    function initGrid(limit = 20) {
        grid = new gridjs.Grid({
            columns: [
                { id: 'id', name: 'ID', width: '50px' },
                { id: 'nome', name: 'Nome' },
                { id: 'cpf', name: 'CPF' },
                { id: 'rg', name: 'RG'},
                {
                    width: '5%',
                    formatter: (_, row) => gridjs.html(`
                        <button class="btn btn-editar" data-id="${row.cells[0].data}"><iconify-icon class="fs-20" icon="solar:pen-outline"></iconify-icon></button>
                        <button class="btn btn-excluir" data-id="${row.cells[0].data}"><iconify-icon class="fs-20" icon="solar:trash-bin-2-outline"></iconify-icon></button>
                    `)
                }
            ],
            server: {
                url: (prev, page) => `/api/pessoas-fisicas?page=${page}&limit=${limit}&search=${encodeURIComponent(currentSearch)}`,
                method: 'GET',
                then: data => data.data.map(p => ({
                    id: p.id,
                    nome: p.nome,
                    cpf: p.cpf,
                    rg: p.rg,
                    email: p.email,
                    telefone: p.telefone
                }))
            },
            search: {
                enabled: false
            },
            sort: true,
            pagination: {
                enabled: true,
                limit: limit,
                server: {
                    url: (prev, page) => `/api/pessoas-fisicas?page=${page}&limit=${limit}&search=${encodeURIComponent(currentSearch)}`
                }
            },
            language: {
                pagination: {
                    previous: 'Anterior',
                    next: 'Próximo',
                    showing: 'Mostrando',
                    of: 'de',
                    to: 'até',
                    results: 'resultados'
                }
            }
        }).render(container);
    }

    function updateGrid(page = 1) {
        grid.updateConfig({
            search: {
                enabled: false // Garante que a busca padrão permaneça desativada
            },
            server: {
                url: `/api/pessoas-fisicas?page=${page}&limit=20&search=${encodeURIComponent(currentSearch)}`,
                then: data => data.data.map(p => ({
                    id: p.id,
                    nome: p.nome,
                    cpf: p.cpf,
                    rg: p.rg,
                    email: p.email,
                    telefone: p.telefone
                }))
            }
        }).forceRender();

        // Remove a caixa de busca padrão após a renderização
        setTimeout(() => {
            const searchBox = container.querySelector('.gridjs-search');
            if (searchBox) {
                searchBox.remove();
            }
        }, 0);
    }

    // Configura o MutationObserver para remover a caixa de busca dinamicamente
    function setupSearchBoxObserver() {
        const observer = new MutationObserver(() => {
            const searchBox = container.querySelector('.gridjs-search');
            if (searchBox) {
                searchBox.remove();
            }
        });

        observer.observe(container, {
            childList: true,
            subtree: true
        });
    }

    searchInput.addEventListener('input', function(e) {
        currentSearch = e.target.value;
        updateGrid(1);
    });

    container.addEventListener("click", function(e) {
        const id = e.target.dataset.id;
        if (e.target.classList.contains("btn-editar")) editar(id);
        if (e.target.classList.contains("btn-excluir")) excluir(id);
    });

    function editar(id) {
        alert("Editar registro ID: " + id);
    }

    function excluir(id) {
        if (!confirm("Deseja realmente excluir o registro ID: " + id + "?")) return;
        fetch(`/api/pessoas-fisicas/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(() => updateGrid())
        .catch(err => console.error(err));
    }

    document.addEventListener('DOMContentLoaded', function() {
        initGrid();
        setupSearchBoxObserver();
    });
</script>
@endsection
