(function () {

    const root = document.documentElement;

    function save(key, value) {
        localStorage.setItem(key, value);
    }

    function load(key) {
        return localStorage.getItem(key);
    }

    // Presets
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            root.dataset.theme = btn.dataset.preset;
            save('theme', btn.dataset.preset);
        });
    });

    // Colores
    document.querySelectorAll('.color-options').forEach(group => {
        const target = group.dataset.target;

        group.querySelectorAll('button').forEach(btn => {
            btn.addEventListener('click', () => {
                const color = getComputedStyle(btn).backgroundColor;

                if (target === 'header') {
                    root.style.setProperty('--semantic-header-color', color);
                    save('headerColor', color);
                }

                if (target === 'footer') {
                    root.style.setProperty('--semantic-footer-color', color);
                    save('footerColor', color);
                }

                if (target === 'links') {
                    root.style.setProperty('--semantic-link-color', color);
                    save('linkColor', color);
                }
            });
        });
    });

    // Fuentes
    document.querySelectorAll('.font-options button').forEach(btn => {
        btn.addEventListener('click', () => {
            let font;

            switch (btn.dataset.font) {
                case 'serif':
                    font = 'Georgia, serif';
                    break;
                case 'mono':
                    font = 'monospace';
                    break;
                default:
                    font = 'system-ui, sans-serif';
            }

            root.style.setProperty('--semantic-font-family', font);
            save('font', font);
        });
    });

    // Restaurar
    document.addEventListener('DOMContentLoaded', () => {
        if (load('theme')) root.dataset.theme = load('theme');
        if (load('headerColor')) root.style.setProperty('--semantic-header-color', load('headerColor'));
        if (load('footerColor')) root.style.setProperty('--semantic-footer-color', load('footerColor'));
        if (load('linkColor')) root.style.setProperty('--semantic-link-color', load('linkColor'));
        if (load('font')) root.style.setProperty('--semantic-font-family', load('font'));
    });

})();