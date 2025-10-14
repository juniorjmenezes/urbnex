@extends('layouts.app')

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
                <button type="button" class="btn btn-sm btn-icon btn-ghost-light text-dark rounded-circle btn-add" data-bs-toggle="tooltip" data-bs-html="true" data-bs-trigger="hover" data-bs-placement="top" data-bs-title="Nova Pessoa Física">
                    <i class="ri-user-add-line fs-18"></i>
                </button>
            </div>
            <input type="text" id="custom-search" class="form-control rounded-pill w-lg-50" placeholder="Buscar...">
        </div>
        <div id="table-pessoas"></div>
    </div>
</div>
@include('pessoas-fisicas.create-modal')
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
                {
                    id: 'nome',
                    name: 'Nome',
                    formatter: (cell, row) => gridjs.html(`
                        <span class="text-dark fw-semibold">${cell}</span>
                    `)
                },
                {
                    id: 'cpf',
                    name: 'CPF',
                    formatter: (cell) => gridjs.html(`
                        <span class="text-dark fw-medium">${cell ?? '-'}</span>
                    `)
                },
                {
                    id: 'rg',
                    name: 'RG',
                    formatter: (cell) => gridjs.html(`
                        <span class="text-dark fw-medium">${cell ?? '-'}</span>
                    `)
                },
                {
                    id: 'acoes',
                    name: '',
                    width: '5%',
                    sort: false,
                    formatter: (_, row) => gridjs.html(`
                        <div class="dropdown flex-shrink-0 text-muted">
                            <a href="#" class="dropdown-toggle drop-arrow-none fs-20 link-reset" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-2-fill"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="" class="dropdown-item btn-editar" data-id="${row.cells[0].data}"><i class="ri-edit-box-line me-1"></i> Editar</a>
                                <a href="" class="dropdown-item btn-excluir" data-id="${row.cells[0].data}"><i class="ri-delete-bin-line me-1"></i> Deletar</a>
                            </div>
                        </div>
                    `)
                }
            ],
            className: {
                tr: 'linha-clicavel',
                table: 'table table-centered table-nowrap mb-0',
                thead: 'table-light',
            },
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

    // === ABRIR MODAL NOVA PESSOA ===
    $(document).ready(function() {
        // Abrir modal
        document.querySelector('.btn-add').addEventListener('click', function () {
            $('#formAddPessoaFisica').trigger('reset');
            $('#id').val('');
            $('#modalAddPessoaFisicaLabel').text('Nova Pessoa Física');
            new bootstrap.Modal(document.getElementById('modalAddPessoaFisica')).show();
        });

        // Botão salvar dispara submit do form
        $('.btn-salvar').on('click', function() {
            $('#formAddPessoaFisica').submit();
        });

        // Submissão AJAX
        $('#formAddPessoaFisica').on('submit', function(e) {
            e.preventDefault();

            let form = $(this);
            let url = form.attr('action');      // route Laravel
            let method = form.attr('method');   // POST
            let formData = form.serialize();

            $.ajax({
                url: url,
                method: method,
                data: formData,
                success: function(response) {
                    $('#modalAddPessoaFisica').modal('hide');
                    form.trigger('reset');

                    // Se a resposta tiver a pessoa recém-criada
                    if (response && typeof updateGrid === 'function') {
                        updateGrid(response);
                    }

                    notyf.success('Pessoa Física cadastrada com sucesso!');
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON?.errors;
                    if (errors) {
                        let mensagens = Object.values(errors).flat().join("\n");
                        notyf.error(mensagens);
                    } else {
                        notyf.error('Ocorreu um erro inesperado.');
                    }
                }
            });
        });
    });
</script>
@endsection
