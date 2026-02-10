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

    const contactForm = document.getElementById('contactForm');
    // ... resta do script original ...


    if (contactForm) {
        contactForm.addEventListener('submit', function (e) {
            e.preventDefault();

            const btn = this.querySelector('button[type="submit"]');
            const originalBtnText = btn.innerHTML;

            // Feedback visual de carregamento
            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enviando...';

            const formData = new FormData(this);

            // Envia para o PHP via AJAX (invisível para o usuário)
            fetch('send.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "success") {
                        alert('Sua mensagem foi enviada com sucesso! Entraremos em contato em breve.');
                        contactForm.reset();
                    } else {
                        alert('Houve um erro ao processar sua solicitação. Por favor, tente novamente mais tarde ou contate-nos pelo WhatsApp.');
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    alert('Erro de conexão com o servidor. Verifique sua rede.');
                })
                .finally(() => {
                    // Restaura o botão
                    btn.disabled = false;
                    btn.innerHTML = originalBtnText;
                });
        });
    }
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