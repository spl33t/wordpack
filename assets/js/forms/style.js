export default function formStyles(form) {
    const inputs = form.querySelectorAll('input[type="text"], input[type="email"], input[type="tel"], textarea')
    const selects = form.querySelectorAll('select')

    //Selects
    selects.forEach(elem => {
        elem.onchange = () => {
            if (!elem.value == '') {
                elem.classList.add('active')
            } else {
                elem.classList.remove('active')
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


    const reqSymbol = '<span style="color: red"> *</span>'
    form.querySelectorAll('[input-req]').forEach(formItem => {
        if (formItem.querySelector('.input-text')) {
            let label = formItem.querySelector('.input-text label')
            label.innerHTML = label.innerHTML + reqSymbol
        }
        if (formItem.querySelector('.input-select')) {
            let label = formItem.querySelector('.input-select label')
            label.innerHTML = label.innerHTML + reqSymbol
        }
        if (formItem.querySelector('.input-group-check__items')) {
            let label = formItem.querySelector('.form-item__title')
            label.innerHTML = label.innerHTML + reqSymbol
        }
        if (formItem.querySelector('.input-single-check')) {
            let label = formItem.querySelector('.input-single-check label')
            label.innerHTML = label.innerHTML + reqSymbol
        }
    })

}