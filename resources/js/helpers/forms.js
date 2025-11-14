// resources/js/helpers/forms.js

const FormHelper = {
    init(formSelector, options = {}) {
        const form = document.querySelector(formSelector);
        if (!form) return;

        form.addEventListener("submit", (e) => {
            e.preventDefault();
            this.submit(form, options);
        });
    },

    async submit(form, options) {
        const action = form.getAttribute("action");
        const method = form.getAttribute("method") || "POST";

        const defaults = {
            beforeSend: () => {},
            onSuccess: () => {},
            onError: () => {},
            onFinish: () => {},
        };

        const config = { ...defaults, ...options };

        config.beforeSend(form);

        try {
            const response = await fetch(action, {
                method: method.toUpperCase(),
                headers: {
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json"
                },
                body: new FormData(form)
            });

            const data = await response.json();

            if (response.ok) {
                config.onSuccess(data, form);
            } else {
                config.onError(data, form);
            }

        } catch (error) {
            config.onError(error, form);
        }

        config.onFinish(form);
    }
};

export default FormHelper;