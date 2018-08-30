import 'babel-polyfill';
import Traders from './components/pages/traders/index';
import Emails from './components/pages/emails/index';
import store from './store'
require('./bootstrap');
window.Vue = require('vue');
const app = new Vue({
    components: {
        Traders,
        Emails
    },
    store,
    el: '#app'
});

Vue.filter('capitalize', function (value) {
    if (!value) return '';
    value = value.toString();
    return value.charAt(0).toUpperCase() + value.slice(1)
});