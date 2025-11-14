// resources/js/actions/pessoa-fisica.js
import FormHelper from "../helpers/forms";

document.addEventListener("DOMContentLoaded", () => {

    const form =
        document.querySelector("#formStorePessoaFisica") ||
        document.querySelector("#formUpdatePessoaFisica");

    if (!form) return; // nada a fazer

    // ==============================
    // SELECTS
    // ==============================
    const generoSelect = $("#genero");
    const paisSelect = $("#pais_origem");
    const estadoCivilSelect = $("#estado_civil");
    const profissaoSelect = $("#profissao");

    // ==============================
    // ATUALIZA LISTAS
    // ==============================
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

    // ==============================
    // SELECT2 COM BANDEIRAS
    // ==============================
    function formatFlag(option) {
        if (!option.id) return option.text;

        const flagCode = $(option.element).data('flag');
        if (!flagCode) return option.text;

        return $(`<span><i class="fi fi-${flagCode} me-2"></i>${option.text}</span>`);
    }

    if ($.fn.select2) {
        paisSelect.select2({
            templateResult: formatFlag,
            templateSelection: formatFlag,
            placeholder: "Selecione um país",
            width: "resolve",
        });
    }

    // ==============================
    // CAMPOS DO DOCUMENTO (RG/CRNM)
    // ==============================
    const rgDiv = document.querySelector("#rg")?.closest(".col-lg-3");
    const crnmDiv = document.querySelector("#rne_crnm")?.closest(".col-lg-3");

    function atualizarCamposDocumento(pais) {
        const isBrasileiro =
            pais === "Brasil" || pais === "BR" || pais === "br";

        if (rgDiv) rgDiv.style.display = isBrasileiro ? "" : "none";
        if (crnmDiv) crnmDiv.style.display = isBrasileiro ? "none" : "";
    }

    // Eventos de atualização dinâmica
    generoSelect.on("change", function () {
        const genero = $(this).val();
        atualizarEstadosCivis(genero);
        atualizarProfissoes(genero);
    });

    paisSelect.on("change", function () {
        atualizarCamposDocumento($(this).val());
    });

    // ==============================
    // ESTADO INICIAL
    // ==============================
    atualizarEstadosCivis(generoSelect.val());
    atualizarProfissoes(generoSelect.val());
    atualizarCamposDocumento(paisSelect.val() || "Brasil");

    // Restaurar valores antigos
    const estadoCivilValor = estadoCivilSelect.data("old") || estadoCivilSelect.val();
    const profissaoValor = profissaoSelect.data("old") || profissaoSelect.val();

    if (estadoCivilValor)
        estadoCivilSelect.val(estadoCivilValor).trigger("change.select2");

    if (profissaoValor)
        profissaoSelect.val(profissaoValor).trigger("change.select2");

    // ==============================
    // ENVIO AJAX (agora com FormHelper)
    // ==============================
    FormHelper.init(`#${form.id}`, {
        rules: {
            nome: { required: true, maxlength: 255 },
            cpf: { required: true, cpfBR: true },
            rg: { maxlength: 14 },
            estado_civil: { required: true, maxlength: 255 },
            profissao: { required: true, maxlength: 255 },
            email: { email: true, maxlength: 255 },
        },
        messages: {
            nome: "Informe o nome completo.",
            cpf: "Informe um CPF válido.",
            email: "Informe um e-mail válido.",
        },

        beforeSend: () => {
            console.log("Enviando dados da PF...");
        },

        onSuccess: (data) => {
            Swal.fire("Sucesso!", data.message, "success");
        },

        onError: () => {
            Swal.fire("Erro!", "Corrija os campos destacados.", "error");
        },
    });
});
