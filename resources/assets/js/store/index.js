import Vue from 'vue'
import Vuex from 'vuex'
import email from './modules/email'

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    modules: {
        email
    },
    strict: debug
})