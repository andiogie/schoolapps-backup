document.addEventListener('DOMContentLoaded', function() {

    // Mobile Menu Toggle
    const navbarToggler = document.querySelector('.navbar-toggler');
    const navbarMenuWrapper = document.querySelector('.navbar-menu-wrapper');

    navbarToggler.addEventListener('click', () => {
        navbarMenuWrapper.classList.toggle('active');
    });

    // Close mobile menu when a link is clicked
    const navLinks = document.querySelectorAll('.navbar-menu a');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navbarMenuWrapper.classList.contains('active')) {
                navbarMenuWrapper.classList.remove('active');
            }
        });
    });

    // Active link highlighting on scroll
    const sections = document.querySelectorAll('section');
    const headerHeight = document.querySelector('.navbar').offsetHeight;

    window.addEventListener('scroll', () => {
        let current = '';
        sections.forEach(section => {
            const sectionTop = section.offsetTop - headerHeight - 50; // 50px offset
            if (pageYOffset >= sectionTop) {
                current = section.getAttribute('id');
            }
        });

        navLinks.forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href').substring(1) === current) {
                link.classList.add('active');
            }
        });
    });

});
