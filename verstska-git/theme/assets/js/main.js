document.addEventListener('DOMContentLoaded', function () {
    const nav = document.querySelector('.nav');
    const button = document.querySelector('.menu');
    const links = document.querySelectorAll('#primary-navigation a');

    function closeMenu() {
        if (!nav || !button) return;
        nav.classList.remove('mobile');
        button.setAttribute('aria-expanded', 'false');
    }

    if (nav && button) {
        button.addEventListener('click', function () {
            const open = nav.classList.toggle('mobile');
            button.setAttribute('aria-expanded', open ? 'true' : 'false');
        });

        links.forEach(function (link) {
            link.addEventListener('click', closeMenu);
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeMenu();
            }
        });

        document.addEventListener('click', function (event) {
            if (nav.classList.contains('mobile') && !nav.contains(event.target) && !button.contains(event.target)) {
                closeMenu();
            }
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 1050) {
                closeMenu();
            }
        });
    }

    document.querySelectorAll('[data-year]').forEach(function (element) {
        element.textContent = new Date().getFullYear();
    });
});
