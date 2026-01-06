document.addEventListener('DOMContentLoaded', () => {

    const root = document.documentElement;

    const headerColor = document.getElementById('color-header');
    const footerColor = document.getElementById('color-footer');
    const linkColor   = document.getElementById('color-links');
    const fontSelect  = document.getElementById('font-family');

    if (headerColor) {
        headerColor.addEventListener('input', e => {
            root.style.setProperty('--semantic-header-color', e.target.value);
            localStorage.setItem('semantic-header-color', e.target.value);
        });
    }

    if (footerColor) {
        footerColor.addEventListener('input', e => {
            root.style.setProperty('--semantic-footer-color', e.target.value);
            localStorage.setItem('semantic-footer-color', e.target.value);
        });
    }

    if (linkColor) {
        linkColor.addEventListener('input', e => {
            root.style.setProperty('--semantic-link-color', e.target.value);
            localStorage.setItem('semantic-link-color', e.target.value);
        });
    }

    if (fontSelect) {
        fontSelect.addEventListener('change', e => {
            root.style.setProperty('--semantic-font-family', e.target.value);
            localStorage.setItem('semantic-font-family', e.target.value);
        });
    }

    // Restaurar preferencias guardadas
    const savedHeader = localStorage.getItem('semantic-header-color');
    const savedFooter = localStorage.getItem('semantic-footer-color');
    const savedLinks  = localStorage.getItem('semantic-link-color');
    const savedFont   = localStorage.getItem('semantic-font-family');

    if (savedHeader) root.style.setProperty('--semantic-header-color', savedHeader);
    if (savedFooter) root.style.setProperty('--semantic-footer-color', savedFooter);
    if (savedLinks)  root.style.setProperty('--semantic-link-color', savedLinks);
    if (savedFont)   root.style.setProperty('--semantic-font-family', savedFont);

    // PRESETS
    document.querySelectorAll('.preset-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const preset = btn.dataset.preset;

            if (preset === 'dark') {
                root.style.setProperty('--semantic-header-color', '#111');
                root.style.setProperty('--semantic-footer-color', '#111');
                root.style.setProperty('--semantic-link-color', '#9cdcfe');
                root.style.setProperty('--semantic-font-family', 'system-ui, sans-serif');
            }

            if (preset === 'terminal') {
                root.style.setProperty('--semantic-header-color', '#000');
                root.style.setProperty('--semantic-footer-color', '#000');
                root.style.setProperty('--semantic-link-color', '#00ff00');
                root.style.setProperty('--semantic-font-family', 'Courier New, monospace');
            }

            if (preset === 'claro') {
                root.style.setProperty('--semantic-header-color', '#f5f5f5');
                root.style.setProperty('--semantic-footer-color', '#f5f5f5');
                root.style.setProperty('--semantic-link-color', '#003366');
                root.style.setProperty('--semantic-font-family', 'system-ui, sans-serif');
            }

            if (preset === 'alto-contraste') {
                root.style.setProperty('--semantic-header-color', '#000');
                root.style.setProperty('--semantic-footer-color', '#fff200');
                root.style.setProperty('--semantic-link-color', '#ff0000');
                root.style.setProperty('--semantic-font-family', 'system-ui, sans-serif');
            }
        });
    });

});