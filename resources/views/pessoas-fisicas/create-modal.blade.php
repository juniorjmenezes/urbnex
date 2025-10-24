<!-- Modal -->
<div class="modal fade" id="modalAddPessoaFisica" tabindex="-1" aria-labelledby="modalAddPessoaFisicaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAddPessoaFisicaLabel">Nova Pessoa Física</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <form id="formStorePessoaFisica">
                <div class="modal-body">
                    <ul class="nav nav-pills bg-nav-pills nav-justified mb-3" id="pessoaTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="dados-tab" data-bs-toggle="tab" data-bs-target="#dados" type="button" role="tab">Dados Pessoais</button>
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
                        <div class="tab-pane fade show active" id="dados" role="tabpanel">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label for="nome" class="form-label">Nome Completo</label>
                                        <input type="text" id="nome" class="form-control" name="nome" value="{{ old('nome') }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <label for="pais_origem" class="form-label">País de Origem</label>
                                    <select id="pais_origem" name="pais_origem" data-placeholder="Escolha...">
                                        <option value="">Escolha...</option>
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
                                        <select id="profissao" name="profissao" data-placeholder="Escolha..." autocomplete="off">
                                            <option value="">Escolha...</option>
                                            <!-- Opções serão carregadas via JS -->
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Documentos -->
                        <div class="tab-pane" id="documentos" role="tabpanel">
                            <div class="row">
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

                        <!-- Contato -->
                        <div class="tab-pane" id="contato" role="tabpanel">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="text" id="telefone" class="form-control" name="telefone" data-toggle="input-mask" data-mask-format="(00) 00000-0000" value="{{ old('telefone') }}">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}">
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
                    <button type="button" form="formStorePessoaFisica" class="btn btn-sm btn-primary btn-salvar">
                        <i class="ri-save-line me-1"></i>
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>