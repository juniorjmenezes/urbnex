/**
 * formHelper.js
 * Helper genérico para jQuery Validate + Notyf + TomSelect + validação de CPF/CNPJ
 */
(function () {
    // --- MÉTODO: Validação de CPF ---
    $.validator.addMethod("cpfBR", function (value, element) {
        value = value.replace(/[^\d]+/g, "");

        if (value.length !== 11 || /^(\d)\1{10}$/.test(value)) return false;

        let soma, resto;
        soma = 0;
        for (let i = 1; i <= 9; i++) soma += parseInt(value.substring(i - 1, i)) * (11 - i);
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        if (resto !== parseInt(value.substring(9, 10))) return false;

        soma = 0;
        for (let i = 1; i <= 10; i++) soma += parseInt(value.substring(i - 1, i)) * (12 - i);
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
        return resto === parseInt(value.substring(10, 11));
    }, "Informe um CPF válido.");

    // --- MÉTODO: Validação de CNPJ ---
    $.validator.addMethod("cnpjBR", function (value, element) {
        value = value.replace(/[^\d]+/g, "");
        if (value.length !== 14) return false;

        // Elimina CNPJs inválidos conhecidos
        if (/^(\d)\1{13}$/.test(value)) return false;

        let tamanho = value.length - 2;
        let numeros = value.substring(0, tamanho);
        let digitos = value.substring(tamanho);
        let soma = 0;
        let pos = tamanho - 7;

        for (let i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) pos = 9;
        }
        let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        if (resultado != digitos.charAt(0)) return false;

        tamanho += 1;
        numeros = value.substring(0, tamanho);
        soma = 0;
        pos = tamanho - 7;
        for (let i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) pos = 9;
        }
        resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
        return resultado == digitos.charAt(1);
    }, "Informe um CNPJ válido.");

    // --- FUNÇÃO PRINCIPAL: configuração de formulário AJAX ---
    window.setupAjaxForm = function (formSelector, options = {}) {
        const form = $(formSelector);
        if (!form.length) return;

        form.validate({
            ignore: [],
            rules: options.rules || {},
            messages: options.messages || {},
            errorElement: "div",
            errorClass: "invalid-feedback",

            highlight(element) {
                $(element).addClass("is-invalid");
            },
            unhighlight(element) {
                $(element).removeClass("is-invalid");
            },
            errorPlacement(error, element) {
                if ($(element).next(".ts-wrapper").length) {
                    error.insertAfter($(element).next(".ts-wrapper"));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: async function (formEl) {
                const formData = new FormData(formEl);

                try {
                    const response = await fetch(formEl.action, {
                        method: formEl.method || "POST",
                        body: formData,
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": document.querySelector('input[name="_token"]').value
                        }
                    });

                    const data = await response.json();

                    if (response.ok) {
                        notyf.success(data.message || "Registro salvo com sucesso!");
                        formEl.reset();
                        $(".is-invalid").removeClass("is-invalid");
                        $(".invalid-feedback").remove();

                        document.querySelectorAll(".ts-wrapper").forEach(wrapper => {
                            const select = wrapper.tomselect;
                            if (select) select.clear();
                        });

                    } else if (response.status === 422) {
                        notyf.error("Alguns campos precisam ser corrigidos.");

                        for (const [field, messages] of Object.entries(data.errors)) {
                            const input = formEl.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add("is-invalid");
                                const feedback = document.createElement("div");
                                feedback.classList.add("invalid-feedback");
                                feedback.innerText = messages[0];
                                input.parentNode.appendChild(feedback);
                            }
                        }

                        const firstInvalid = formEl.querySelector(".is-invalid");
                        if (firstInvalid) {
                            firstInvalid.scrollIntoView({ behavior: "smooth", block: "center" });
                        }

                    } else {
                        notyf.error(data.message || "Ocorreu um erro ao salvar o formulário.");
                    }

                } catch (error) {
                    notyf.error("Falha de conexão com o servidor.");
                }
            }
        });
    };
})();