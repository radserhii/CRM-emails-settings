import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'

window._ = require('lodash');
window.moment = require('moment');
window.daterangepicker = require('daterangepicker');
window.Popper = require('popper.js').default;
try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) {}
window.axios = require('axios');

Vue.use(BootstrapVue);
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}