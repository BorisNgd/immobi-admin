/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css';
import '../css/sb-admin-2.css';

import $ from 'jquery';
import 'bootstrap';
import  'datatables.net';
import 'bootstrap/dist/js/bootstrap.bundle';
import 'bootstrap4-toggle/css/bootstrap4-toggle.min.css'
import '@fortawesome/fontawesome-free/js/all';
import '../css/custom.css';
import 'bootstrap4-toggle/js/bootstrap4-toggle.min';

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
// import $ from 'jquery';

$(document).ready(function () {
    $('.js-datepicker').datepicker({
        format: "dd-mm-yyyy"
    });


});



console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
