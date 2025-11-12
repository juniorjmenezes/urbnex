import './bootstrap';
import Inputmask from "inputmask";
import './helpers/masks';

document.addEventListener('DOMContentLoaded', function () {
    MaskHelper.init();
});

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
