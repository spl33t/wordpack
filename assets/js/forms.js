
    formValidate()

    function formValidate() {

        const forms = document.querySelectorAll('.form-order');

        forms.forEach(form => {
            const inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], textarea')
            const selects = form.querySelectorAll('select')

            //Selects
            selects.forEach(e => {
                e.onchange = () => {
                    if (!e.value == '') {
                        e.classList.add('active')
                    } else {
                        e.classList.remove('active')
                    }
                }
            })

            //Inputs and TextArea
            inputs.forEach(e => {
                e.oninput = function () {
                    if (e.value.length > 0) {
                        e.classList.add('active')
                    } else {
                        e.classList.remove('active')
                    }
                }
            })
        })

        forms.forEach((form) => {

            //Validate
            jQuery(form).submit(function (event) {
                let error = formValidate(form);

                if (error === 0) {
                    form.classList.add('_sending');

                    var formData = {
                        name: jQuery("[name='name']").val(),
                        phone: form.querySelector('[name="tel"]').value,
                        comment: jQuery("[name='comment']").val(),
                        message: jQuery("[name='message']").val(),
                        page: document.title,
                        pageurl: document.URL,
                    };
                    jQuery.ajax({
                        type: "POST",
                        url: templateUrl + '/includes/mail-send.php',
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

    }

    export { formValidate }



