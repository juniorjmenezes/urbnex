// resources/js/helpers/masks.js
const hasInputmask = typeof Inputmask !== 'undefined';

const Masks = {
    init() {
        if (!hasInputmask) return console.warn('Inputmask não encontrado. MasksHelper não foi inicializado.');
        this.telefones();
        this.cpf();
        this.cnpj();
        this.cep();
        this.dataBr();
    },

    _apply(opts, selector) {
        if (!hasInputmask) return;
        const nodes = typeof selector === 'string' ? document.querySelectorAll(selector) : selector;
        if (!nodes || nodes.length === 0) return;
        Inputmask(opts).mask(nodes);
    },

    telefones(selector = 'input[data-mask="telefone"]') {
        if (!hasInputmask) return;
        Inputmask({
            mask: [
                '(99) 9 9999-9999',
                '(99) 9999-9999'
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

    dataBr(selector = 'input[data-mask="dataBr"]') {
        this._apply({ mask: '99/99/9999', showMaskOnHover: false }, selector);
    },

    telefonesDynamic(selector = 'input[data-mask="telefone"]') {
        if (!hasInputmask) return;
        Inputmask({
            mask(value) {
                const numbers = value.replace(/\D/g, '');
                return numbers.length > 10 ? '(99) 9 9999-9999' : '(99) 9999-9999';
            },
            keepStatic: true,
            showMaskOnHover: false
        }).mask(document.querySelectorAll(selector));
    }
};

// === EXPORT DEFAULT 100% compatível com Vite ===
export default Masks;

// === TORNA GLOBAL OPCIONAL (não interfere no Vite) ===
if (typeof window !== 'undefined') {
    window.MaskHelper = Masks;
}