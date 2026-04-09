document.addEventListener('DOMContentLoaded', () => {
    const header = document.getElementById('header');

    if (!header) return;

    window.addEventListener('scroll', function () {
        if (window.scrollY > 10) {
            header.classList.add('is-sticky');
        } else {
            header.classList.remove('is-sticky');
        }
    });

    const slider = document.querySelector('.js-hero-slider');

    if (!slider) return;

    const items = slider.querySelectorAll('.hero__item');

    if (items.length <= 1) return;

    let currentIndex = 0;
    const intervalTime = 3000;

    setInterval(() => {
        const currentItem = items[currentIndex];
        const nextIndex = (currentIndex + 1) % items.length;
        const nextItem = items[nextIndex];

        currentItem.classList.remove('is-active');
        currentItem.classList.add('is-exit');

        nextItem.classList.remove('is-exit');
        nextItem.classList.add('is-active');

        setTimeout(() => {
            currentItem.classList.remove('is-exit');
        }, 800);

        currentIndex = nextIndex;
    }, intervalTime);
});
