document.addEventListener('DOMContentLoaded', () => {
    if (!window.SemanticWPBackgrounds?.allowed) return;

    const selector = document.querySelector('[data-bg-selector]');
    if (!selector) return;

    selector.addEventListener('change', e => {
        const value = e.target.value;
        localStorage.setItem('semantic-wp-bg', value);
        document.documentElement.setAttribute('data-bg', value);
    });

    const saved = localStorage.getItem('semantic-wp-bg');
    if (saved) {
        document.documentElement.setAttribute('data-bg', saved);
    }
});