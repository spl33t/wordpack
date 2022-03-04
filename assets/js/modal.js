import startValidate from './forms/index'
import {observerByClass} from './other-scripts'

let modalBtn = document.querySelectorAll("[data-modal]")
modalBtn.forEach(btn => {
    let modalName = btn.getAttribute('data-modal')

    //Open Modal by btn
    btn.addEventListener('click', displayPopupByBtn)

    jQuery(document).ready(function ($) {
        const data = {
            action: 'modal_ajax',
            modal: modalName
        }

        jQuery.post(myajax.url, data, function (response) {
            let responseToHTML = document.createElement('div');
            responseToHTML.innerHTML = response;

            let modal = responseToHTML.querySelector(`.modal`)
            let modalId = modal.id

            // Проверка если уже есть такая модалка на странице
            if (!document.querySelector(`#${modalId}`)) {
                jQuery("body").append(modal)
            }


        }).fail(function () {
            alert('Попап не найден')
        })
    })
})

//Обработчики для модалок
jQuery(document).ready(function ($) {
    document.querySelectorAll('.modal').forEach(modal => {
        if (!modal.classList.contains('init')) {
            modalFormValidate(modal)
            modalConditionsDisplay(modal)
            closeModal(modal)

            modal.classList.add('init')
        }
    })
});

// Обработчики для AJAX модалок
function modalObserver(modal) {
    if (!modal.classList.contains('init')) {
        modalFormValidate(modal)
        modalConditionsDisplay(modal)
        closeModal(modal)

        modal.classList.add('init')
    }
}
observerByClass('modal', modalObserver)

function modalFormValidate(modal) {
    let form = modal.querySelectorAll('.form-mailing')
    if (form !== null) {
        startValidate(form)
    }
}

function modalConditionsDisplay(modal) {
    let modalClases = modal.classList
    for (let i = 0; i < modalClases.length; i++) {
        // Показ с задержкой в секундах после загрузки страницы
        if (modalClases[i].includes('delay')) {
            let delay = modalClases[i].split('_')[1] * 1000

            setTimeout(() => {
                displayPopup(modal)
            }, delay)
        }
        // Показ после прокрутки страницы в процентах ОТ 0 до 100 %
        if (modalClases[i].includes('scroll')) {
            let precent = modalClases[i].split('_')[1]
            window.addEventListener("scroll", modalByScroll)

            function modalByScroll(e) {
                let scrollTop = jQuery(window).scrollTop();
                let docHeight = jQuery(document).height();
                let winHeight = jQuery(window).height();
                let scrollPercent = (scrollTop) / (docHeight - winHeight);
                let scrollPercentRounded = Math.round(scrollPercent * 100);
                if (scrollPercentRounded > precent) {
                    displayPopup(modal)
                    window.removeEventListener("scroll", modalByScroll)
                }
            }
        }
    }
}

// Display by Btn
function displayPopupByBtn(e) {
    let modalName = e.target.getAttribute('data-modal')
    let modal = document.querySelector(`#modal-${modalName}`)
    displayPopup(modal)
}

// Remove Popup
function displayPopup(modal) {
    modal.classList.add("is-active");
    document.body.style.overflow = 'hidden'
}

// Remove Popup
function closeModal(modal) {
    modal.addEventListener('click', (e) => {
        let target = e.target.className
        if (target === 'modal-inner' || target === 'modal' || target === 'modal__close') {
            modal.classList.remove("is-active");
            document.body.style.overflow = 'auto'
        }
    })
}




