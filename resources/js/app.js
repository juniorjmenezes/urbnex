import './bootstrap';
import './helpers/masks';
import './helpers/forms';

document.addEventListener('DOMContentLoaded', function () {
    MaskHelper.init();
});

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();
