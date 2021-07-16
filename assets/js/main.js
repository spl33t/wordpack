import * as $ from 'jquery';
import Flickity from 'flickity'

//Flickity Slider
let gallery = document.getElementsByClassName('gallery')
if (gallery.length !== 0) {
    var flky = new Flickity('.gallery', {
        cellAlign: 'left',
        contain: true,
        freeScroll: true,
        prevNextButtons: false,
        pageDots: false
    });
}

//Валидация и AJAX отправка формы
$(document).ready(function () {
    const form = document.getElementById('form-order');

    $(form).submit(function (event) {
        let error = formValidate(form);

        if (error === 0) {
            form.classList.add('_sending');

            var formData = {
                name: $("[name='name']").val(),
                phone: $("[name='phone']").val(),
                comment: $("[name='comment']").val(),
                message: $("[name='message']").val(),
            };

            $.ajax({
                type: "POST",
                url: "/wp-content/themes/wp-webpack/mail-send.php",
                data: formData,
                dataType: "json",
                encode: true,
            }).done(function (data) {
                console.log(data);
                if (data.message == 'Success!') {
                    form.reset();
                    form.classList.remove('_sending');
                } else {
                    form.classList.remove('_sending');
                }
            });

        } else {
            alert('Заполните обязательные поля');
        }
        event.preventDefault();
    });

    function formValidate(form) {
        let error = 0;
        let formReq = document.querySelectorAll('._req')

        for (let i = 0; i < formReq.length; i++) {
            const input = formReq[i];
            formRemoveError(input);
            if (input.value === '') {
                formAddError(input);
                error++;
            }
        }
        return error;
    }

    function formAddError(input) {
        //input.parentElement.classList.add('_error');
        input.classList.add('_error');
    }
    function formRemoveError(input) {
        //input.parentElement.classList.remove('_error');
        input.classList.remove('_error');
    }

});

