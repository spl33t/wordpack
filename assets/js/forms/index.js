import orderValidate from './orderValidate'
import formStyles from "@js/forms/style";

const formsOrder = document.querySelectorAll(".form-mailing")

export default function startValidate(forms) {
    forms.forEach(form => {
        orderValidate(form)
        formStyles(form)
    })
}

startValidate(formsOrder)
