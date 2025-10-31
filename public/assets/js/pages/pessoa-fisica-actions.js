document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("#formStorePessoaFisica") || document.querySelector("#formUpdatePessoaFisica");
    if (!form) return;

    // ===== Campos =====
    const generoSelect = $("#genero");
    const paisSelect = $("#pais_origem");
    const estadoCivilSelect = $("#estado_civil");
    const profissaoSelect = $("#profissao");

    // ===== Atualizadores =====
    function atualizarEstadosCivis(genero) {
        let lista = [];
        if (genero === "m") lista = ESTADOS_CIVIS_MASCULINOS;
        else if (genero === "f") lista = ESTADOS_CIVIS_FEMININOS;
        else lista = [...ESTADOS_CIVIS_MASCULINOS, ...ESTADOS_CIVIS_FEMININOS];

        estadoCivilSelect.empty().append('<option value="">Escolha...</option>');
        lista.forEach(e => estadoCivilSelect.append(new Option(e, e)));
        estadoCivilSelect.trigger("change.select2");
    }

    function atualizarProfissoes(genero) {
        let lista = [];
        if (genero === "m") lista = PROFISSOES_MASCULINAS;
        else if (genero === "f") lista = PROFISSOES_FEMININAS;
        else lista = [...PROFISSOES_MASCULINAS, ...PROFISSOES_FEMININAS];

        profissaoSelect.empty().append('<option value="">Escolha...</option>');
        lista.forEach(p => profissaoSelect.append(new Option(p, p)));
        profissaoSelect.trigger("change.select2");
    }

    // ===== Eventos =====
    generoSelect.on("change", function () {
        const genero = $(this).val();
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

    paisSelect.on("change", function () {
        atualizarCamposDocumento($(this).val());
    });

    // ===== Estado inicial =====
    const generoInicial = generoSelect.val();
    const paisInicial = paisSelect.val() || "Brasil";

    atualizarEstadosCivis(generoInicial);
    atualizarProfissoes(generoInicial);
    atualizarCamposDocumento(paisInicial);

    // ===== Restaura valores antigos (edição) =====
    const estadoCivilValor = estadoCivilSelect.data("old") || estadoCivilSelect.val();
    const profissaoValor = profissaoSelect.data("old") || profissaoSelect.val();

    if (estadoCivilValor) estadoCivilSelect.val(estadoCivilValor).trigger("change.select2");
    if (profissaoValor) profissaoSelect.val(profissaoValor).trigger("change.select2");

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