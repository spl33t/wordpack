jQuery(document).ready(function ($) {

    const forms = document.querySelectorAll('.form-order');

    forms.forEach((form) => {

        $(form).submit(function (event) {
            let error = formValidate(form);

            if (error === 0) {
                form.classList.add('_sending');

                var formData = {
                    name: $("[name='name']").val(),
                    phone: form.querySelector('[name="phone"]').value,
                    comment: $("[name='comment']").val(),
                    message: $("[name='message']").val(),
                    page: document.title,
                    pageurl: document.URL,
                };
                $.ajax({
                    type: "POST",
                    url: templateUrl + '/mail-send.php',
                    data: formData,
                    dataType: "json",
                    encode: true,
                }).done(function (data) {
                    if (data.message == 'Success!') {
                        form.reset();
                        form.classList.remove('_sending');
                        form.classList.add('_complete');
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
            let formReq = form.querySelectorAll('._req')

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

    })

});