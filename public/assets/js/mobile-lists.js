(() => {
    const mobileQuery = window.matchMedia('(max-width: 767px)');
    const excludedSelector = '.fc, .calendar, [data-mobile-table="scroll"], [role="presentation"]';

    const shouldEnhance = (table) => {
        if (!(table instanceof HTMLTableElement) || table.matches(excludedSelector) || table.closest(excludedSelector)) {
            return false;
        }

        const headers = table.querySelectorAll('thead th');
        return headers.length > 1 && table.querySelector('tbody');
    };

    const enhanceTable = (table) => {
        if (!shouldEnhance(table)) return;

        if (!mobileQuery.matches) {
            table.classList.remove('mobile-card-table');
            return;
        }

        const headers = Array.from(table.querySelectorAll('thead th')).map((header, index) => {
            const label = (header.textContent || '').replace(/\s+/g, ' ').trim();
            return label || `ستون ${index + 1}`;
        });

        table.classList.add('mobile-card-table');
        table.querySelectorAll('tbody tr').forEach((row) => {
            Array.from(row.children).forEach((cell, index) => {
                if (!(cell instanceof HTMLTableCellElement) || cell.colSpan > 1) return;
                cell.dataset.mobileLabel = headers[index] || '';
            });
        });
    };

    const enhanceAll = (root = document) => {
        if (root instanceof HTMLTableElement) enhanceTable(root);
        root.querySelectorAll?.('.dvanimation table').forEach(enhanceTable);
    };

    const start = () => {
        enhanceAll();

        const observer = new MutationObserver((mutations) => {
            if (!mobileQuery.matches) return;
            mutations.forEach((mutation) => mutation.addedNodes.forEach((node) => {
                if (node instanceof Element) enhanceAll(node);
            }));
        });

        observer.observe(document.querySelector('.dvanimation') || document.body, {
            childList: true,
            subtree: true,
        });

        mobileQuery.addEventListener('change', () => enhanceAll());
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', start, { once: true });
    } else {
        start();
    }
})();
