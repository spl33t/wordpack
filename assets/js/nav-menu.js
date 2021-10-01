/** 
/ Navigation
*/

const headerMenuWrapper = document.querySelector('.main-navigation-wrapper')
const mainNav = headerMenuWrapper.querySelector('.nav-main')
const itemsHasChildren = mainNav.querySelectorAll('.menu-item-has-children')
const burgerBtn = headerMenuWrapper.querySelector('.burger-menu')
const burgerLabel = burgerBtn.querySelector('.burger-menu-label')



burgerBtn.addEventListener('click', function () {
    this.classList.toggle('active');
    upd()
})


function upd() {
    if (burgerBtn.classList.contains('active')) {
        openMenu()
    } else {
        closeMenu()
    }
}

function openMenu() {
    burgerBtn.classList.add('active');
    document.body.style.overflow = 'hidden'
    mainNav.classList.add('active');
    burgerLabel.innerHTML = 'Закрыть меню'
    burgerBtn.ariaLabel = 'Закрыть главное меню навигации по сайту'
}

function closeMenu() {
    burgerBtn.classList.remove('active');
    document.body.removeAttribute("style")
    mainNav.classList.remove('active');
    burgerLabel.innerHTML = 'Открыть меню'
    burgerBtn.ariaLabel = 'Открыть главное меню навигации по сайту'
}


// Дропдовн по нажатию
document.addEventListener('click', (e) => {
    if (e.target.className == 'dropdown-toggle') {
        const ul = e.target.nextElementSibling
        ul.classList.toggle('active')
    }

})


function checkForWindowResize() {
    //console.log(`Screen width: ${window.innerWidth}`);

    if (window.innerWidth <= 768) { // Small

    }
    else { // Large
        closeMenu()
    }
}

checkForWindowResize()
window.addEventListener('resize', checkForWindowResize);

