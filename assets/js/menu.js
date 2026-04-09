document.addEventListener('DOMContentLoaded', () => {
    const burger = document.querySelector('.burger');
    const mobileMenu = document.querySelector('.mobile-menu');

    if (!burger || !mobileMenu) return;

    const openSubmenuLabel = mobileMenu.dataset.openSubmenu || 'Открыть подменю';
    const closeSubmenuLabel = mobileMenu.dataset.closeSubmenu || 'Закрыть подменю';

    const menuItemsWithChildren = mobileMenu.querySelectorAll('.menu-item-has-children');

    menuItemsWithChildren.forEach((item) => {
        const link = item.querySelector(':scope > a');
        const subMenu = item.querySelector(':scope > .sub-menu');

        if (!link || !subMenu) return;

        if (item.querySelector(':scope > .submenu-toggle')) return;

        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'submenu-toggle';
        button.setAttribute('aria-expanded', 'false');
        button.setAttribute('aria-label', openSubmenuLabel);
        button.innerHTML = `
            <span class="icon icon-arrow menu-arrow">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.25" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down-icon lucide-chevron-down" aria-hidden="true">
                    <path d="m6 9 6 6 6-6"></path>
                </svg>
            </span>
        `;

        link.insertAdjacentElement('afterend', button);

        button.addEventListener('click', (e) => {
            e.preventDefault();
            e.stopPropagation();

            const isOpen = item.classList.toggle('is-open');

            button.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
            button.setAttribute('aria-label', isOpen ? closeSubmenuLabel : openSubmenuLabel);
        });
    });

    burger.addEventListener('click', () => {
        const isOpen = burger.classList.toggle('is-active');

        mobileMenu.classList.toggle('is-active', isOpen);
        document.body.classList.toggle('menu-open', isOpen);

        burger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
        burger.setAttribute(
            'aria-label',
            isOpen ? burger.dataset.closeLabel : burger.dataset.openLabel
        );

        if (!isOpen) {
            menuItemsWithChildren.forEach((item) => {
                item.classList.remove('is-open');

                const button = item.querySelector(':scope > .submenu-toggle');
                if (button) {
                    button.setAttribute('aria-expanded', 'false');
                    button.setAttribute('aria-label', openSubmenuLabel);
                }
            });
        }
    });
});
