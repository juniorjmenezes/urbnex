document.addEventListener("DOMContentLoaded", function () {
    // ===== Detecta formulário =====
    const form = document.querySelector("#formStorePessoaFisica") || document.querySelector("#formUpdatePessoaFisica");
    if (!form) return;

    // ===== Inicializa TomSelect =====
    initTomSelect(["#genero"]);

    // País de origem com bandeiras
    const tsPaisOrigem = new TomSelect("#pais_origem", {
        render: {
            option: data => `<div><span class="fi fi-${data.flag} me-2"></span> ${data.text}</div>`,
            item: data => `<div><span class="fi fi-${data.flag} me-1"></span> ${data.text}</div>`
        }
    });

    // Estado civil
    const tsEstadoCivil = new TomSelect("#estado_civil", {
        create: false,
        sortField: { field: "text", direction: "asc" }
    });

    // Profissão
    const tsProfissao = new TomSelect("#profissao", {
        create: true,
        sortField: { field: "text", direction: "asc" }
    });

    // ===== Atualizadores =====
    function atualizarEstadosCivis(genero) {
        let lista = [];
        if (genero === "m") lista = ESTADOS_CIVIS_MASCULINOS;
        else if (genero === "f") lista = ESTADOS_CIVIS_FEMININOS;
        else lista = [...ESTADOS_CIVIS_MASCULINOS, ...ESTADOS_CIVIS_FEMININOS];

        tsEstadoCivil.clearOptions();
        tsEstadoCivil.addOption(lista.map(e => ({ value: e, text: e })));
        tsEstadoCivil.refreshOptions(false);
    }

    function atualizarProfissoes(genero) {
        let lista = [];
        if (genero === "m") lista = PROFISSOES_MASCULINAS;
        else if (genero === "f") lista = PROFISSOES_FEMININAS;
        else lista = [...PROFISSOES_MASCULINAS, ...PROFISSOES_FEMININAS];

        tsProfissao.clearOptions();
        tsProfissao.addOption(lista.map(p => ({ value: p, text: p })));
        tsProfissao.refreshOptions(false);
    }

    // ===== Eventos =====
    const generoSelect = document.querySelector("#genero");
    const paisSelect = document.querySelector("#pais_origem");

    generoSelect.addEventListener("change", function () {
        const genero = this.value;
        atualizarEstadosCivis(genero);
        atualizarProfissoes(genero);
    });

    // ===== Exibição RG / CRNM =====
    const rgDiv = document.querySelector("#rg")?.closest(".col-md-3");
    const crnmDiv = document.querySelector("#rne_crnm")?.closest(".col-md-3");

    function atualizarCamposDocumento(pais) {
        const isBrasileiro = pais === "Brasil" || pais === "BR";
        if (rgDiv) rgDiv.style.display = isBrasileiro ? "" : "none";
        if (crnmDiv) crnmDiv.style.display = isBrasileiro ? "none" : "";
    }

    paisSelect.addEventListener("change", function () {
        atualizarCamposDocumento(this.value);
    });

    // ===== Estado inicial =====
    const generoInicial = generoSelect.value;
    const paisInicial = paisSelect.value || "Brasil";

    // Popula sempre (com base no gênero ou com tudo)
    atualizarEstadosCivis(generoInicial);
    atualizarProfissoes(generoInicial);
    atualizarCamposDocumento(paisInicial);

    // ===== Restaura valores anteriores (na edição) =====
    const estadoCivilValor = tsEstadoCivil.input.getAttribute("data-old") || tsEstadoCivil.input.value;
    const profissaoValor = tsProfissao.input.getAttribute("data-old") || tsProfissao.input.value;

    if (estadoCivilValor) tsEstadoCivil.setValue(estadoCivilValor, true);
    if (profissaoValor) tsProfissao.setValue(profissaoValor, true);

    // ===== Validação e envio AJAX =====
    setupAjaxForm(`#${form.id}`, {
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