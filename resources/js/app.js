import './bootstrap';

// Helpers
import MaskHelper from './helpers/masks';
import ViaCepHelper from './helpers/ceps';
import FormHelper from './helpers/forms';

// Deixa globais apenas os helpers que precisar
window.MaskHelper = MaskHelper;
window.ViaCepHelper = ViaCepHelper;
window.FormHelper = FormHelper;

// Actions
import './actions/pessoa-fisica';

// Document Ready
document.addEventListener("DOMContentLoaded", () => {
    MaskHelper.init();
    ViaCepHelper.init();
});
