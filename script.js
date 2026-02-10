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

// Mantém as outras funções de menu hamburguer (se existirem no teu script original)
const hamburger = document.querySelector('.hamburger');
const navMenu = document.querySelector('.nav-menu');
if (hamburger) {
    hamburger.addEventListener('click', () => {
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('active');
    });
}