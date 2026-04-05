// ScrollReveal System
class ScrollReveal {
    constructor() {
        this.revealElements = document.querySelectorAll('.reveal');
        this.init();
    }

    init() {
        const observerOptions = {
            threshold: 0.15,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    // Desmonitora após revelar
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        this.revealElements.forEach(el => observer.observe(el));
    }
}

// Aguarda o DOM carregar
document.addEventListener('DOMContentLoaded', () => {
    new ScrollReveal();


});

// Aguarda o DOM carregar
document.addEventListener('DOMContentLoaded', () => {
    new ScrollReveal();

    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');
    const navLinks = document.querySelectorAll('.nav-menu a');
    const body = document.body;

    const toggleMenu = () => {
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('active');
        body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : 'auto';
    };

    if (hamburger) {
        hamburger.addEventListener('click', toggleMenu);
    }

    // Fecha ao clicar no link
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (navMenu.classList.contains('active')) {
                toggleMenu();
            }
        });
    });

    // Tap Feedback (Brutalist)
    const interactables = document.querySelectorAll('.service-card, .btn, .portfolio-item');
    interactables.forEach(item => {
        item.addEventListener('touchstart', () => {
            item.style.transform = 'scale(0.98)';
        }, { passive: true });
        
        item.addEventListener('touchend', () => {
            item.style.transform = '';
        }, { passive: true });
    });
});