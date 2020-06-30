/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import '../css/sb-admin-2.css';
import '../css/dataTables.bootstrap4.min.css';

window.$ = window.jQuery = require('jquery');
require('jquery-ui');
require('jquery-ui-bundle');

import 'bootstrap';
require('datatables.net-bs4');
import '@fortawesome/fontawesome-free/js/all';
import 'bootstrap4-toggle/css/bootstrap4-toggle.min.css'
import '../css/custom.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

$(document).ready(function () {

    $('.js-datepicker').datepicker({
        format: "dd-MM-yyyy"
    });


});



console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
