import '../css/main.css';

document.addEventListener('DOMContentLoaded', () => {
    // if (document.querySelector('#app')) {
    //     import('./admin.js')
    // }

    if (window.location.pathname.includes('/admin/categories')) {
        import('./categories.js');
    }
})