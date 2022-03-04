// Send form
export default function sendForm(form) {
    let submitButton = form.querySelector('[type=submit]')
    submitButton.value = 'Отправка...'
    form.classList.add('_sending');

    const formData = {
        page: document.title,
        pageUrl: document.URL,
    }


    form.querySelectorAll('.form-item').forEach(formItem => {

        if (formItem.querySelector('.input-text')) {
            let input = formItem.querySelector('.input-text').firstElementChild
            let inputValue = input.value
            let inputKey = formItem.querySelector('.input-text label').innerText

            formData[inputKey] = inputValue
        }

        if (formItem.querySelector('.input-select')) {
            let input = formItem.querySelector('.input-select select')
            let inputValue = input.selectedOptions[0].text
            let inputKey = formItem.querySelector('.input-select label').innerText

            formData[inputKey] = inputValue
        }

        if (formItem.querySelector('.input-group-check__items')) {
            let inputs = formItem.querySelectorAll('.input-group-check__items')

            inputs.forEach(input => {
                let inputKey = formItem.querySelector('.form-item__title').innerText
                let checkedLabels = []

                input.querySelectorAll('.input-check input:checked').forEach(checkedInput => {
                    checkedLabels.push(checkedInput.labels[0].innerText)
                })

                formData[inputKey] = checkedLabels.join(', ')
            })
        }

        if (formItem.querySelector('.input-single-check')) {
            let input = formItem.querySelector('.input-single-check').firstElementChild
            let inputValue = 'Да'
            let inputKey = input.labels[0].innerText

            formData[inputKey] = inputValue
        }

    })

    jQuery.ajax({
        type: "POST",
        url: templateUrl + '/includes/mail-send.php',
        data: formData,
        dataType: "json",
        encode: true,
    }).done(function (data) {
        if (data.message === "Success!") {
            //console.log("Отправлено");

            form.reset();
            form.classList.remove('_sending');
            form.classList.add('_complete');
            form.querySelector('[type=submit]').value = 'Сообщение отправлено!'
            setTimeout(() => form.querySelector('[type=submit]').value = 'Отправить', 5000)
        } else {
            //console.log("not Отправлено");

            form.classList.remove('_sending');
            form.querySelector('[type=submit]').value = 'Отправить'
        }
    })
}