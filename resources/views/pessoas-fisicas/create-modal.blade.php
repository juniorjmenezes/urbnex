<!-- Modal -->
<div class="modal fade" id="modalAddPessoaFisica" tabindex="-1" aria-labelledby="modalAddPessoaFisicaLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddPessoaFisicaLabel">Nova Pessoa Física</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <form id="formAddPessoaFisica" method="POST"> 
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="nome" class="form-label">Nome Completo</label>
                                <input type="text" id="nome" class="form-control" name="nome" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" id="cpf" class="form-control" name="cpf"  data-toggle="input-mask" data-mask-format="999.999.999-99">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="rg" class="form-label">RG</label>
                                <input type="text" id="rg" class="form-control" name="rg">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="estado_civil" class="form-label">Estado Civil</label>
                                <select id="estado_civil" name="estado_civil" class="form-control select2" data-toggle="select2" data-placeholder="Escolha..." dropdownParent="#modalPessoaFisica">
                                    @foreach ($estados_civis as $estado_civil)
                                        <option></option>
                                        <option value="{{ $estado_civil }}" {{ old('estado_civil') == $estado_civil ? 'selected' : '' }}>
                                            {{ $estado_civil }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="profissao" class="form-label">Profissão</label>
                                <select id="profissao" name="profissao" class="form-control select2" data-toggle="select2" data-placeholder="Escolha..." dropdownParent="#modalPessoaFisica">
                                    <option value="">Escolha...</option>
                                    @foreach ($profissoes as $profissao)
                                        <option value="{{ $profissao }}" {{ old('profissao') == $profissao ? 'selected' : '' }}>
                                            {{ $profissao }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" id="telefone" class="form-control" name="telefone" data-toggle="input-mask" data-mask-format="(00) 00000-0000">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" class="form-control" name="email">
                            </div>
                        </div>

                        <!-- Endereço -->
                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" id="cep" class="form-control" name="cep" data-toggle="input-mask" data-mask-format="99999-999">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="logradouro" class="form-label">Logradouro</label>
                                <input type="text" id="logradouro" class="form-control" name="logradouro" placeholder="Ex.: Rua 7 de Setembro">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-2">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" id="numero" class="form-control" name="numero">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-sm-3 mb-lg-0">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" id="complemento" class="form-control" name="complemento">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-sm-3 mb-lg-0">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" id="bairro" class="form-control" name="bairro">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-sm-3 mb-lg-0">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" id="cidade" class="form-control" name="cidade">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-sm-3 mb-lg-0">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" id="estado" class="form-control" name="estado">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" form="formPessoaFisica" class="btn btn-primary btn-salvar">
                    <i class="ri-save-line me-1"></i>
                    Salvar
                </button>
            </div>
        </div>
    </div>
</div>