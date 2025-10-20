/**
 * Helper para inicializar TomSelect com opções padrão
 * @param {string|Array} selectors - Seletor ou lista de seletores (ex: "#estado_civil" ou ["#estado_civil", "#profissao"])
 * @param {object} options - Opções adicionais para o TomSelect (sobrescrevem as padrão)
 */
function initTomSelect(selectors, options = {}) {
    const defaultOptions = {
        create: false,
        createOnBlur: false,
        sortField: {
            field: "text",
            direction: "asc"
        },
    };

    // Garante que sempre trabalharemos com uma lista
    const elements = Array.isArray(selectors) ? selectors : [selectors];

    elements.forEach(selector => {
        const el = document.querySelector(selector);
        if (el) {
            new TomSelect(el, Object.assign({}, defaultOptions, options));
        } else {
            console.warn(`Elemento não encontrado: ${selector}`);
        }
    });
}