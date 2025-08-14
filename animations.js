// smooth-scroll.js

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Smooth scrolling when arriving from another page with a hash
document.addEventListener("DOMContentLoaded", function () {
    if (window.location.hash) {
        const target = document.querySelector(window.location.hash);
        if (target) {
            // Prevent default jump
            window.scrollTo(0, 0);
            setTimeout(() => {
                target.scrollIntoView({ behavior: 'smooth' });
            }, 100);
        }
    }
});
// See All Trainers Button Logic
document.addEventListener("DOMContentLoaded", function () {
    const seeAllBtn = document.getElementById('seeAllTrainers');
    if (seeAllBtn) {
        seeAllBtn.addEventListener('click', function () {
            document.querySelectorAll('.hidden-trainer').forEach(function (card) {
                card.style.display = 'flex';
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 50);
            });
            // Hide the button after showing all
            this.style.display = 'none';
        });
    }
});

        // Header background change on scroll
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.header');
            if (window.scrollY > 100) {
                header.style.background = 'rgba(0, 0, 0, 0.98)';
            } else {
                header.style.background = 'rgba(0, 0, 0, 0.95)';
            }
        });

        // Add animation on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all cards
        document.querySelectorAll('.service-card, .trainer-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
