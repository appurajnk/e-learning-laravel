/**
 * This bootstrap file is used for both frontend and backend
 */

import _ from 'lodash'
import axios from 'axios'
import Swal from 'sweetalert2';
import $ from 'jquery';
import 'popper.js'; // Required for BS4
import 'bootstrap';
window.$ = window.jQuery = $;
window.Swal = Swal;
window._ = _; // Lodash

import toast from './toast'

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
const token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    //console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

axios.interceptors.response.use(
    function(response) {
        return response;
    },
    function(error) {        
        if (error.response) {
            const { status } = error.response
            if(status == 403 && error.response.data && error.response.data.type=='demo'){
                toast.error(error.response.data.message);
            }
        }

        return Promise.reject(error)
    }
);

(function($) { 
    "use strict"; 
    $(window).scroll(function(){
        if ($(this).scrollTop() > 130) {
            $('.course_details__preview').addClass('fixed');
            $('.clp-component-render').addClass('d-none');
            $('.fullwidth__fixed').removeClass('d-none');
        } else {
            $('.course_details__preview').removeClass('fixed');
            $('.clp-component-render').removeClass('d-none');
            $('.fullwidth__fixed').addClass('d-none');
        }
    });
})(jQuery);
