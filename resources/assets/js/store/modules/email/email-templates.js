const state = {
    templates: [],
    templateEditable: {},
    errorTemplate: '',
    messageTemplate: ''
};

const getters = {
};

const actions = {

    fetchAllTemplates({commit}) {
        axios.get('/emails/templates')
            .then((response) => {
                commit('setTemplates', response.data);
            })
            .catch((error) => {
                commit('setTemplateError', error.message);
            })
    },
    setTemplateEditable({commit}, template) {
        commit('setTemplateEditable', template);
    },
    editTitleText({commit}, text) {
        commit('setTitleText', text);
    },
    saveTemplate({commit, dispatch}, logo) {

        let formData = new FormData();
        formData.append('file',  logo);
        formData.append('template',  JSON.stringify(state.templateEditable));

        axios.post('/emails/templates', formData,
        ).then((response) => {
            commit('setTemplateMessage', response.data.message);
            dispatch('fetchAllTemplates')
        }).catch((error) => {
            commit('setTemplateError', error.message);
        })
    }
};

const mutations = {
    setTemplates(state, templates) {
        state.templates = templates;
    },
    setTemplateEditable(state, template) {
        state.templateEditable = template;
    },
    setTitleText(state, text) {
        state.templateEditable.headerTitle = text;
    },
    // Error
    setTemplateError(state, error) {
        state.errorTemplate = error;
    },
    setTemplateMessage(state, message) {
        state.messageTemplate = message;
    },
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}