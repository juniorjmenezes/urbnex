@extends('layouts.app')

@section('title', 'Nova Pessoa Física')

@section('content')
<div class="mb-3">
    <h4 class="page-title fs-16 fw-semibold mb-0">@yield('title')</h4>
</div>

<div class="card">
    <div class="card-header border-bottom border-dashed d-flex align-items-center">
        <h4 class="header-title">Insira os dados da Pessoa Física</h4>
    </div>
    <div class="card-body">
        <form action="{{ route('pessoasFisicas.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome Completo</label>
                        <input type="text" id="nome" class="form-control" name="nome" required>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" id="cpf" class="form-control" name="cpf"  data-toggle="input-mask" data-mask-format="999.999.999-99">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="rg" class="form-label">RG</label>
                        <input type="text" id="rg" class="form-control" name="rg">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="estado_civil" class="form-label">Estado Civil</label>
                        <select id="estado_civil" name="estado_civil" class="form-control" data-choices>
                            <option value="">Selecione...</option>
                            <option value="Solteiro">Solteiro</option>
                            <option value="Casado">Casado</option>
                            <option value="Separado">Separado</option>
                            <option value="Divorciado">Divorciado</option>
                            <option value="Viúvo">Viúvo</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="profissao" class="form-label">Profissão</label>
                        <select id="profissao" name="profissao" class="form-control select2" data-toggle="select2">
                            <option value="">Selecione...</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Advogado">Advogado</option>
                            <option value="Agente de Segurança">Agente de Segurança</option>
                            <option value="Arquiteto">Arquiteto</option>
                            <option value="Artista">Artista</option>
                            <option value="Assistente Administrativo">Assistente Administrativo</option>
                            <option value="Assistente Social">Assistente Social</option>
                            <option value="Atendente">Atendente</option>
                            <option value="Autônomo">Autônomo</option>
                            <option value="Bancário">Bancário</option>
                            <option value="Bibliotecário">Bibliotecário</option>
                            <option value="Biólogo">Biólogo</option>
                            <option value="Cabeleireiro">Cabeleireiro</option>
                            <option value="Cantor">Cantor</option>
                            <option value="Contador">Contador</option>
                            <option value="Cozinheiro">Cozinheiro</option>
                            <option value="Designer Gráfico">Designer Gráfico</option>
                            <option value="Desenvolvedor">Desenvolvedor</option>
                            <option value="Dentista">Dentista</option>
                            <option value="Economista">Economista</option>
                            <option value="Eletricista">Eletricista</option>
                            <option value="Enfermeiro">Enfermeiro</option>
                            <option value="Engenheiro Civil">Engenheiro Civil</option>
                            <option value="Engenheiro Mecânico">Engenheiro Mecânico</option>
                            <option value="Empresário">Empresário</option>
                            <option value="Farmacêutico">Farmacêutico</option>
                            <option value="Fisioterapeuta">Fisioterapeuta</option>
                            <option value="Fotógrafo">Fotógrafo</option>
                            <option value="Funcionário Público">Funcionário Público</option>
                            <option value="Garçom">Garçom</option>
                            <option value="Jornalista">Jornalista</option>
                            <option value="Marceneiro">Marceneiro</option>
                            <option value="Médico">Médico</option>
                            <option value="Motorista">Motorista</option>
                            <option value="Nutricionista">Nutricionista</option>
                            <option value="Pedreiro">Pedreiro</option>
                            <option value="Professor">Professor</option>
                            <option value="Recepcionista">Recepcionista</option>
                            <option value="Secretário">Secretário</option>
                            <option value="Segurança">Segurança</option>
                            <option value="Soldador">Soldador</option>
                            <option value="Técnico em Informática">Técnico em Informática</option>
                            <option value="Vendedor">Vendedor</option>
                            <option value="Veterinário">Veterinário</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" id="telefone" class="form-control" name="telefone" data-toggle="input-mask" data-mask-format="(00) 00000-0000">
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" name="email">
                    </div>
                </div>

                <!-- Endereço -->
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" id="cep" class="form-control" name="cep" data-toggle="input-mask" data-mask-format="99999-999">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="logradouro" class="form-label">Logradouro</label>
                        <input type="text" id="logradouro" class="form-control" name="logradouro" placeholder="Ex.: Rua 7 de Setembro">
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

                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" id="bairro" class="form-control" name="bairro">
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
            </div>
            <!-- Botão de salvar -->
            <button type="submit" class="btn btn-primary text-uppercase">Salvar</button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/components/form-inputmask.js') }}"></script>
@endsection
