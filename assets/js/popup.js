
jQuery(document).ready(function ($) {

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
                        <div class="popup__body">
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
                                <input class="xl-input" type="text" name="name" placeholder="Имя">
                                <input class="xl-input _req" type="text" name="phone" required="true" placeholder="Телефон *">
                                <textarea name="textarea" placeholder="Сообщение"></textarea>
                                <textarea name="comment"></textarea>
                                <textarea name="message"></textarea>
                                <button class="button-brand xl-button">Отправить</button>
                            </form>
                        </div>
                        </div>
                      `
        }


        popup.innerHTML = template

        document.body.append(popup)
        document.body.style.overflow = 'hidden'
    }

})