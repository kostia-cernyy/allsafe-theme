document.addEventListener('DOMContentLoaded', () => {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
            }
        });
    });

    document.querySelectorAll('.fade-up').forEach((el) => {
        observer.observe(el);
    });
});
