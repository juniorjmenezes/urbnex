// resources/js/helpers/masks.js
// Helper global para aplicar máscaras Inputmask
// Requer: Inputmask (já incluso no Metronic) ou importado via npm

(function (global) {
    const hasInputmask = typeof Inputmask !== 'undefined';

    const Masks = {
        init() {
            if (!hasInputmask) return console.warn('Inputmask não encontrado. MasksHelper não foi inicializado.');
            this.telefones();
            this.cpf();
            this.cnpj();
            this.cep();
            this.date(); // renomeado para evitar ambiguidade
        },

        _apply(opts, selector) {
            if (!hasInputmask) return;
            // aceita string selector ou NodeList
            const nodes = typeof selector === 'string' ? document.querySelectorAll(selector) : selector;
            if (!nodes || nodes.length === 0) return;
            Inputmask(opts).mask(nodes);
        },

        /**
         * Telefones:
         * - celular: (99) 9 9999-9999
         * - fixo: pode ser '(99) 9999-9999' ou '99 9999-9999' (ajuste abaixo)
         *
         * Aqui deixei a opção de fixo COM parênteses como padrão,
         * se preferir sem parênteses troque '(99) 9999-9999' por '99 9999-9999'
         */
        telefones(selector = 'input[data-mask="telefone"]') {
            if (!hasInputmask) return;
            Inputmask({
                mask: [
                    '(99) 9 9999-9999', // celular
                    '(99) 9999-9999'    // fixo (com parênteses). se quiser sem: '99 9999-9999'
                ],
                keepStatic: true,
                showMaskOnHover: false,
            }).mask(document.querySelectorAll(selector));
        },

        cpf(selector = 'input[data-mask="cpf"]') {
            this._apply({ mask: '999.999.999-99', showMaskOnHover: false }, selector);
        },

        cnpj(selector = 'input[data-mask="cnpj"]') {
            this._apply({ mask: '99.999.999/9999-99', showMaskOnHover: false }, selector);
        },

        cep(selector = 'input[data-mask="cep"]') {
            this._apply({ mask: '99999-999', showMaskOnHover: false }, selector);
        },

        // renomeado de "data" para "date" para evitar ambiguidade com atributos HTML5
        dateBR(selector = 'input[data-mask="dateBR"]') {
            this._apply({ mask: '99/99/9999', showMaskOnHover: false }, selector);
        },

        // caso queira uma versão que detecta telefone por quantidade de dígitos dinamicamente:
        telefonesDynamic(selector = 'input[data-mask="telefone"]') {
            if (!hasInputmask) return;
            Inputmask({
                mask: function (value) {
                    const numbers = value.replace(/\D/g, '');
                    return numbers.length > 10 ? '(99) 9 9999-9999' : '(99) 9999-9999';
                },
                keepStatic: true,
                showMaskOnHover: false
            }).mask(document.querySelectorAll(selector));
        }
    };

    // export compatível com Vite / imports e também global
    if (typeof module !== 'undefined' && module.exports) {
        module.exports = Masks;
    }
    global.MaskHelper = Masks;
})(window);

// Exemplo de inicialização (colocar em app.js ou chamar manualmente)
document.addEventListener('DOMContentLoaded', () => {
    if (window.MaskHelper && typeof window.MaskHelper.init === 'function') {
        window.MaskHelper.init();
    }
});