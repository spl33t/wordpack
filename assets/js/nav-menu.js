
/* Бургер меню */
const headerMenu = document.querySelector('.header-menu');
const burgerBtn = document.querySelector('.header-burger-menu');
burgerBtn.addEventListener('click', function () {
    this.classList.toggle('active');
    headerMenu.classList.toggle('active');
})
/* Бургер меню */