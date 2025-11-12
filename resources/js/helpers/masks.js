/**
 * inputmask.helper.js — helper global para aplicar máscaras Inputmask
 * Requer: Inputmask (já incluso no Metronic)
 */

window.MaskHelper = {
    init() {
        this.telefones();
        this.cpf();
        this.cnpj();
        this.cep();
    },

    telefones(selector = 'input[data-mask="telefone"]') {
        Inputmask({
            mask: [
                '(99) 9 9999-9999', // celular
                '(99) 9999-9999'    // fixo
            ],
            keepStatic: true,
            showMaskOnHover: false
        }).mask(document.querySelectorAll(selector));
    },

    cpf(selector = 'input[data-mask="cpf"]') {
        Inputmask({
            mask: '999.999.999-99',
            showMaskOnHover: false
        }).mask(document.querySelectorAll(selector));
    },

    cnpj(selector = 'input[data-mask="cnpj"]') {
        Inputmask({
            mask: '99.999.999/9999-99',
            showMaskOnHover: false
        }).mask(document.querySelectorAll(selector));
    },

    cep(selector = 'input[data-mask="cep"]') {
        Inputmask({
            mask: '99999-999',
            showMaskOnHover: false
        }).mask(document.querySelectorAll(selector));
    },
};