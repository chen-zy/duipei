require('./bootstrap');

try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap-sass');
} catch (e) {
}