<template>
    <div class="mt-3 mx-5">
        <h4 class="pl-5 mt-5">Service</h4>
        <div class="line"></div>
        <b-col sm="6">
            <span v-if="errorSetting" class="text-danger">{{ errorSetting }}</span>
            <span v-if="messageSetting" class="text-success">{{ messageSetting }}</span>
            <b-row align-v="center" class="my-3" v-for="setting in settings" :key="setting.id">
                <b-col sm="3">
                    <label :for="`setting-${setting.id}`">
                        <b>{{ setting.name | capitalize }}:</b>
                    </label>
                </b-col>
                <b-col sm="9">
                    <b-form-input
                            :id="`setting-${setting.id}`"
                            :name="setting.name"
                            :value="setting.value"
                            @keyup.native.enter="updateSetting($event, setting)"
                            @blur.native="updateSetting($event, setting)">
                    </b-form-input>
                </b-col>
            </b-row>
        </b-col>
        <h4 class="pl-5 mt-5">Events</h4>
        <div class="line"></div>
        <b-col sm="8">
            <span v-if="errorAction" class="text-danger">{{ errorAction }}</span>
            <span v-if="messageAction" class="text-success">{{ messageAction }}</span>
            <b-row class="my-3">
                <b-col sm="3">
                    <b>Name</b>
                </b-col>
                <b-col sm="3">
                    <b>Enable/Disable</b>
                </b-col>
                <b-col sm="6">
                    <b>Sender</b>
                </b-col>
            </b-row>
            <b-row align-v="center" class="my-3" v-for="action in actions" :key="action.id">
                <b-col sm="3">
                    {{ action.name | capitalize | formatActionName}}
                </b-col>
                <b-col sm="3">
                    <toggle-button :value="action.enabled"
                                   color="#82C7EB"
                                   :sync="true"
                                   :labels="true"
                                   @change="toggleActionHandler($event, action)">
                    </toggle-button>
                </b-col>
                <b-col sm="6">
                    <b-form-input
                            type="email"
                            :value="action.sender || getDefaultEmailSender"
                            @keyup.native.enter="updateActionSender($event, action)"
                            @blur.native="updateActionSender($event, action)">
                    </b-form-input>
                </b-col>
            </b-row>
        </b-col>
    </div>
</template>

<script>
    import {mapState, mapGetters} from 'vuex'
    import ToggleButton from '../../common/Button'

    export default {
        name: "settings",
        created() {
            this.$store.dispatch('emailSettings/fetchAllSettings');
            this.$store.dispatch('emailSettings/fetchAllActions');
        },
        computed: {
            ...mapState('emailSettings', ['settings', 'actions', 'messageSetting', 'errorSetting', 'messageAction', 'errorAction']),
            ...mapGetters('emailSettings', ['getDefaultEmailSender'])
        },
        methods: {
            updateSetting(event, setting) {
                if(event.type === 'keyup') event.target.blur();
                this.$store.dispatch('emailSettings/editSetting', {id: setting.id, value: event.target.value});
                this.saveSettings();
            },
            saveSettings() {
                this.$store.dispatch('emailSettings/saveSettings');
            },
            toggleActionHandler(event, action) {
                this.$store.dispatch('emailSettings/toggleAction', {id: action.id, value: event.value});
                this.saveActions()
            },
            updateActionSender(event, action) {
                if(event.type === 'keyup') event.target.blur();
                this.$store.dispatch('emailSettings/editActionSender', {id: action.id, value: event.target.value});
                this.saveActions()
            },
            saveActions() {
                this.$store.dispatch('emailSettings/saveActions');
            },
        },
        filters: {
            formatActionName(value) {
                if (!value) return '';
                return value.split('_').join(' ');
            }
        },
        components: {
            ToggleButton
        }
    }
</script>

<style>
    h4 {
        font-family: Realway;
        color: #8a8484;
        font-weight: bold;
    }

    p {
        font-family: Realway;
    }

    .line {
        border-top: 1px solid #e6e5e5;
        padding-top: 5px;
        padding-bottom: 5px;
        /*margin: 40px auto 0;*/
        width: 100%;
        position: relative;
    }

    .line:before {
        content: "";
        width: 10px;
        height: 10px;
        background: #e6e5e5;
        border-radius: 5px;
        position: absolute;
        top: -6px;
    }

    .line:after {
        right: 0;
    }
</style>