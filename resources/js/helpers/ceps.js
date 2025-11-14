// resources/js/helpers/ceps.js

/**
 * Helper para buscar endereço pelo CEP usando ViaCEP
 */

const ViaCepHelper = {

    init() {
        const cepInput = document.querySelector('#cep');
        if (!cepInput) return;

        cepInput.addEventListener('blur', () => {
            const cep = cepInput.value.replace(/\D/g, '');
            if (cep.length === 8) {
                this.buscarCEP(cep);
            }
        });
    },

    async buscarCEP(cep) {
        try {
            const url = `https://viacep.com.br/ws/${cep}/json/`;

            const response = await fetch(url);
            if (!response.ok) throw new Error('Erro ao consultar ViaCEP');

            const data = await response.json();
            if (data.erro) throw new Error('CEP não encontrado');

            this.preencherCampos(data);

        } catch (err) {
            console.warn('Erro ViaCEP:', err.message);
            this.limparCampos();
        }
    },

    preencherCampos(data) {
        const campos = {
            logradouro: '#logradouro',
            bairro: '#bairro',
            localidade: '#cidade',
            uf: '#estado'
        };

        if (document.querySelector(campos.logradouro))
            document.querySelector(campos.logradouro).value = data.logradouro || '';

        if (document.querySelector(campos.bairro))
            document.querySelector(campos.bairro).value = data.bairro || '';

        if (document.querySelector(campos.localidade))
            document.querySelector(campos.localidade).value = data.localidade || '';

        if (document.querySelector(campos.uf))
            document.querySelector(campos.uf).value = data.uf || '';
    },

    limparCampos() {
        ['#logradouro', '#bairro', '#cidade', '#estado'].forEach(id => {
            const el = document.querySelector(id);
            if (el) el.value = '';
        });
    }
};

// === export default para Vite ===
export default ViaCepHelper;

// === opcional: tornar global ===
if (typeof window !== 'undefined') {
    window.ViaCepHelper = ViaCepHelper;
}
