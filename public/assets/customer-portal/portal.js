(() => {
    const body = document.body;
    document.querySelectorAll('[data-sidebar-open]').forEach((button) => button.addEventListener('click', () => body.classList.add('sidebar-visible')));
    document.querySelectorAll('[data-sidebar-close]').forEach((button) => button.addEventListener('click', () => body.classList.remove('sidebar-visible')));
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') body.classList.remove('sidebar-visible');
    });

    document.querySelectorAll('[data-toast-close]').forEach((button) => button.addEventListener('click', () => button.closest('[data-toast]')?.remove()));
    const toast = document.querySelector('[data-toast]');
    if (toast) window.setTimeout(() => toast.classList.add('is-hiding'), 4500);

    document.querySelectorAll('[data-auto-submit]').forEach((control) => control.addEventListener('change', () => control.form?.submit()));

    document.querySelectorAll('[data-tab-target]').forEach((button) => {
        button.addEventListener('click', () => {
            const wrapper = button.closest('[data-tabs]');
            wrapper?.querySelectorAll('[data-tab-target]').forEach((item) => item.classList.toggle('is-active', item === button));
            wrapper?.querySelectorAll('[data-tab-panel]').forEach((panel) => panel.hidden = panel.dataset.tabPanel !== button.dataset.tabTarget);
        });
    });
})();
