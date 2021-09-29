import IMask from 'imask';

jQuery(document).ready(function ($) {

  var inputPhone = document.querySelectorAll('input[name="phone"]');

  var maskOptions = {
    mask: '+{7} (000) 000-00-00'
  };
  
  if (inputPhone != null) {
    inputPhone.forEach((e) => {
      var mask = IMask(e, maskOptions);
    })
  }
  

});

