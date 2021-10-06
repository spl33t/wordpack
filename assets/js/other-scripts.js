import svg4everybody from 'svg4everybody/dist/svg4everybody.js'
import 'mdn-polyfills/Node.prototype.remove'
import 'mdn-polyfills/Object.assign'
import 'mdn-polyfills/Element.prototype.toggleAttribute'

// ForEach Polyfil
if (window.NodeList && !NodeList.prototype.forEach) {
    NodeList.prototype.forEach = function (callback, thisArg) {
        thisArg = thisArg || window;
        for (var i = 0; i < this.length; i++) {
            callback.call(thisArg, this[i], i, this);
        }
    };
}

svg4everybody();

jQuery(document).ready(function ($) {

});







