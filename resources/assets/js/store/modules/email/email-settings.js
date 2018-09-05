const state = {
    settings: [],
    actions: [],
    messageSetting: '',
    errorSetting: '',
    messageAction: '',
    errorAction: ''
};

const getters = {
    getDefaultEmailSender(state) {
        if(state.settings.length == 0) return;
        let setting = state.settings.find((setting) => {
            return setting.name === 'default sender';
        });
        return setting.value;
    }
};

const actions = {
    // Email Settings
    fetchAllSettings({commit}) {
        axios.get('/emails/settings')
            .then((response) => {
                commit('setSettings', response.data);
            })
            .catch((error) => {
                commit('setSettingError', error.message);
            })
    },
    editSetting({commit}, payload) {
        commit('editSetting', payload);
    },
    saveSettings({commit}) {
        axios.post('/emails/settings', {
            settings: state.settings
        }).then((response) => {
        }).catch((error) => {
            commit('setSettingError', error.message);
        })
    },
    // Email Actions
    fetchAllActions({commit}) {
        axios.get('/emails/actions')
            .then((response) => {
                commit('setActions', response.data);
            })
            .catch((error) => {
                commit('setActionError', error.message);
            })
    },
    toggleAction({commit}, payload) {
        commit('toggleAction', payload);
    },
    editActionSender({commit}, payload) {
        commit('editActionSender', payload);
    },
    saveActions({commit}) {
        axios.post('/emails/actions', {
            actions: state.actions
        }).then((response) => {
        }).catch((error) => {
            commit('setActionError', error.message);
        })
    }
};

const mutations = {
    // Email Settings
    setSettings(state, settings) {
        state.settings = settings;
    },
    editSetting(state, payload) {
        const settingIndex = state.settings.findIndex(setting => setting.id === payload.id);
        state.settings[settingIndex].value = payload.value;
    },
    // Email Actions
    setActions(state, actions) {
        state.actions = actions;
    },
    toggleAction(state, payload) {
        const actionIndex = state.actions.findIndex(action => action.id === payload.id);
        state.actions[actionIndex].enabled = payload.value;
    },
    editActionSender(state, payload) {
        const actionIndex = state.actions.findIndex(action => action.id === payload.id);
        state.actions[actionIndex].sender = payload.value;
    },
    // Error
    setSettingError(state, error) {
        state.errorSetting = error;
    },
    setSettingMessage(state, message) {
        state.messageSetting = message;
    },
    setActionError(state, error) {
        state.errorAction = error;
    },
    setActionMessage(state, message) {
        state.messageAction = message;
    },

};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}