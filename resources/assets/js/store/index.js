import Vue from 'vue'
import Vuex from 'vuex'
import emailSettings from './modules/email/email-settings'
import emailTemplates from './modules/email/email-templates'

Vue.use(Vuex);

const debug = process.env.NODE_ENV !== 'production';

export default new Vuex.Store({
    modules: {
        emailSettings,
        emailTemplates
    },
    strict: debug
})