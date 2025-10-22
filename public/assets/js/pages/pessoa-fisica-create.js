document.addEventListener("DOMContentLoaded", function () {

    // Inicializa Tom Select
    initTomSelect(["#genero"]);

    // Tom Select personalizado para País de Origem com bandeiras
    const tsPaisOrigem = new TomSelect("#pais_origem", {
        render: {
            option: data => `<div><span class="fi fi-${data.flag} me-2"></span> ${data.text}</div>`,
            item: data => `<div><span class="fi fi-${data.flag} me-1"></span> ${data.text}</div>`
        }
    });

    // Tom Selects dinâmicos para Estado Civil e Profissão
    const tsEstadoCivil = new TomSelect("#estado_civil", {
        create: false,
        sortField: { field: "text", direction: "asc" }
    });

    const tsProfissao = new TomSelect("#profissao", {
        create: true,
        sortField: { field: "text", direction: "asc" }
    });

    // Atualiza opções com base no gênero
    function atualizarEstadosCivis(genero) {
        const lista = genero === "m" ? ESTADOS_CIVIS_MASCULINOS : ESTADOS_CIVIS_FEMININOS;
        tsEstadoCivil.clearOptions();
        tsEstadoCivil.addOption(lista.map(e => ({ value: e, text: e })));
        tsEstadoCivil.refreshOptions(false);
    }

    function atualizarProfissoes(genero) {
        const lista = genero === "m" ? PROFISSOES_MASCULINAS : PROFISSOES_FEMININAS;
        tsProfissao.clearOptions();
        tsProfissao.addOption(lista.map(p => ({ value: p, text: p })));
        tsProfissao.refreshOptions(false);
    }

    // Evento de mudança no campo Gênero
    const generoSelect = document.querySelector("#genero");

    generoSelect.addEventListener("change", function() {
        const genero = this.value;
        if (genero) {
            atualizarEstadosCivis(genero);
            atualizarProfissoes(genero);
        } else {
            tsEstadoCivil.clearOptions();
            tsProfissao.clearOptions();
        }
    });

    // Atualiza os selects iniciais, se já houver valor
    if (generoSelect.value) {
        atualizarEstadosCivis(generoSelect.value);
        atualizarProfissoes(generoSelect.value);
    }

    // ===== Controle de exibição RG / crnm =====
    const rgDiv = document.querySelector("#rg").closest(".col-md-3");
    const crnmDiv = document.querySelector("#crnm").closest(".col-md-3");

    function atualizarCamposDocumento(pais) {
        const isBrasileiro = pais === "Brasil";
        rgDiv.style.display = isBrasileiro ? "" : "none";
        crnmDiv.style.display = isBrasileiro ? "none" : "";
    }

    // Evento de mudança no país
    const paisSelect = document.querySelector("#pais_origem");
    paisSelect.addEventListener("change", function() {
        const pais = this.value;
        atualizarCamposDocumento(pais);
    });

    // Estado inicial
    atualizarCamposDocumento(paisSelect.value || "BR");

    // ===== Validação e envio AJAX =====
    setupAjaxForm("#formPessoaFisica", {
        rules: {
            nome: { required: true, maxlength: 255 },
            cpf: { required: true, cpfBR: true },
            rg: { maxlength: 14 },
            estado_civil: { maxlength: 255 },
            profissao: { maxlength: 255 },
            email: { email: true, maxlength: 255 },
            telefone: { required: true, maxlength: 15 }
        },
        messages: {
            nome: "Informe o nome completo.",
            cpf: "Informe um CPF válido.",
            telefone: "Informe o telefone.",
            email: "Informe um e-mail válido."
        }
    });
});