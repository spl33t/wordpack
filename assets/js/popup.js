import { formValidate } from './forms'


jQuery(document).ready(function ($) {

    const pageContent = document.querySelector('.page-content')

    let data = new Object()

    // Create Popup Element
    const popup = document.createElement('div');
    popup.className = "popup";
    popup.addEventListener('click', (e) => {
        let target = e.target.className
        if (target == 'content' || target == 'popup' || target == 'popup__close') {
            removePopup()
        }
    })

    // Remove Popup
    function removePopup() {
        popup.remove()
        data = {}
        document.body.style.overflow = 'auto'
    }

    // Popup init for Media (img, viedo, audio)
    const mediaElements = document.querySelectorAll('.popup-media')
    mediaElements.forEach(e => {
        e.addEventListener('click', function () {
            data.type = 'media'
            data.media = e.getAttribute('src')
            createPopup(data)
        })
    })

    // Popup init for Messages Button
    const ElementsWithMessages = document.querySelectorAll('.popup-message')
    ElementsWithMessages.forEach(e => {
        e.addEventListener('click', function () {
            data.type = 'message'
            data.title = e.getAttribute('data-title')
            data.text = e.getAttribute('data-text')
            createPopup(data)
        })
    })

    // Popup init for Form Button
    const ElementsWithForms = document.querySelectorAll('.popup-form')
    ElementsWithForms.forEach(e => {
        e.addEventListener('click', function () {
            data.type = 'form'
            data.title = e.getAttribute('data-title')
            data.text = e.getAttribute('data-text')
            data.form = e.getAttribute('data-form')
            createPopup(data)
        })
    })


    function createPopup(data) {

        let template = '';

        if (data.type == 'media') {
            template = `
                        <div class="content">
                        <div class="popup__body popup__body-media">
                            <div class="popup__close">x</div>
                            <img class="popup-media" src="${data.media}" alt="">
                        </div>
                        </div>
                      `
        }

        if (data.type == 'message') {
            template = `
                        <div class="content">
                        <div class="popup__body">
                            <div class="popup__close">x</div>
                            <h6 class="popup__title">${data.title}</h6>
                            <p class="popup__text">${data.text}</p>
                        </div>
                        </div>
                      `
        }

        if (data.type == 'form') {
            template = `
                        <div class="content">
                            <div class="popup__body">
                                <div class="popup__close">x</div>
                                <h6 class="popup__title">${data.title}</h6>
                                <p class="popup__text">${data.text}</p>

                                <form class="form-order" id="form-popup">
                                    <div class="input-field">
                                        <input id="name" name="name" type="text">
                                        <label for="name">Имя</label>
                                    </div>
                                    <div class="input-field">
                                        <input class="_req" id="tel" name="tel" type="tel" required="">
                                        <label for="tel">Телефон</label>
                                    </div>
                                    <div class="input-field">
                                        <textarea id="letter" name="letter"> </textarea>
                                        <label for="letter">Сообщение</label>
                                    </div>
                                    <textarea name="comment"></textarea>
                                    <textarea name="message"></textarea>
                                    <input type="submit" value="Отправить">
                                </form>

                            </div>
                        </div>
                      `
        }


        popup.innerHTML = template
        if (data.type == 'form') {
            pageContent.append(popup)
            formValidate()
        } else {
            pageContent.append(popup)
        }

    
        document.body.style.overflow = 'hidden'
    }

})