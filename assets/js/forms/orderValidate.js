import IMask from 'imask'
import sendForm from './sendForm'
import formStyles from './style'

export default function orderValidate(form) {
    formInitState(form)

    // Event Submit
    form.addEventListener("submit", (event) => {
        event.preventDefault()
        formValidate(form)
    })

    // Init State
    function formInitState(form) {
        //Add phone mask
        const inputPhones = form.querySelectorAll('[type="tel"]')
        inputPhones.forEach(inputPhone => {
            if (inputPhone !== null) {
                const maskOptions = {mask: "+{7} (000) 000-00-00"}
                new IMask(inputPhone, maskOptions)
            }
        })
    }

    // Form validate
    const formValidate = (form) => {
        removeErrors(form)

        let formItems = form.querySelectorAll('.form-item')

        formItems.forEach(formItem => {
            // req
            if (formItem.hasAttribute('input-req')) {
                if (formItem.querySelector('.input-text')) {
                    reqText(formItem)
                }
                if (formItem.querySelector('.input-select')) {
                    reqSelect(formItem)
                }
                if (formItem.querySelector('.input-group-check__items')) {
                    reqCheckGroup(formItem)
                }
                if (formItem.querySelector('.input-single-check')) {
                    reqCheck(formItem)
                }
            }

            //phone
            if (formItem.querySelector('input[type="tel"]')) {
                checkPhone(formItem)
            }

            if (formItem.querySelector('input[type="email"]')) {
                checkEmail(formItem)
            }
        })

        // Send form
        if (form.querySelectorAll('._error-input').length === 0) {
            sendForm(form)
        }

    }

    // Req inputs check
    function reqText(formItem) {
        let input = formItem.querySelector('.input-text').firstElementChild
        if (input.value === '') {
            errDisplay(formItem, input, 'Обязательное поле!')
        }
    }

    function reqSelect(formItem) {
        let input = formItem.querySelector('.input-select').firstElementChild
        if (input.value === '') {
            errDisplay(formItem, input, 'Обязательное поле!')
        }
    }

    function reqCheckGroup(formItem) {
        let input = formItem.querySelector('.input-group-check__items')
        if (input.querySelectorAll('.input-check input:checked').length === 0) {
            errDisplay(formItem, input, 'Обязательное поле!')
        }
    }

    function reqCheck(formItem) {
        let input = formItem.querySelector('.input-single-check input')
        if (!input.checked) {
            errDisplay(formItem, input, 'Обязательное поле!')
        }
    }

    // Type inputs check
    function checkPhone(formItem) {
        let inputs = formItem.querySelectorAll('.input-text input[type="tel"]')
        inputs.forEach(input => {
            let inputValue = input.value
            let inputLength = input.value.length

            if (inputLength < 18) {
                errDisplay(formItem, input, `Введенный номер слишком короткий ${inputLength} симв. Нужная длина 18 симв.`)
            }
            if (inputValue.substr(4, 1) != 9 && inputValue.substr(4, 1) != 4) {
                errDisplay(formItem, input, `Номер не может начинатся с цифры ${inputValue.substr(4, 1)}`)
            }
        })

    }

    function checkEmail(formItem) {
        let validRegex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
        let inputs = formItem.querySelectorAll('.input-text input[type="email"]')
        inputs.forEach(input => {
            let inputValue = input.value

            if (!inputValue.match(validRegex)) {
                errDisplay(formItem, input, 'Адрес электронной почты должен содержать символ @ и доменное имя!')
            }
        })



    }

    // Display error
    function errDisplay(formItem, input, message) {
        input.classList.add('_error-input')

        let alertMessage = document.createElement('div')
        alertMessage.className = "form__message-alert"
        alertMessage.innerHTML = `<strong>${message}</strong>`

        formItem.append(alertMessage)
    }

    // Remove errors
    function removeErrors(form) {
        form.querySelectorAll('._error-input').forEach(err => {
            err.classList.remove('_error-input')
        })

        form.querySelectorAll('.form__message-alert').forEach(err => {
            err.remove()
        })
    }
}
