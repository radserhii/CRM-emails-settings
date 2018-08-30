<template>
    <div class="mt-3">
        <h4 class="pl-5 mt-5">Service</h4>
        <div class="line"></div>
        <b-col sm="6">
            <b-row class="my-3" v-for="setting in settings" :key="setting.id">
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
                            @change.native="editSetting($event, setting.id)">
                    </b-form-input>
                </b-col>
            </b-row>
            <button class="btn btn-primary mr-2" @click="saveSettings">Save</button>
            <span v-if="errorSetting" class="text-danger">{{ errorSetting }}</span>
            <span v-if="messageSetting" class="text-success">{{ messageSetting }}</span>
        </b-col>
        <h4 class="pl-5 mt-5">Events</h4>
        <div class="line"></div>
        <b-col sm="8">
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
            <b-row class="my-3" v-for="action in actions" :key="action.id">
                <b-col sm="3">
                    {{ action.name | capitalize | formatActionName}}
                </b-col>
                <b-col sm="3">
                    <toggle-button :value="action.enabled"
                                   color="#82C7EB"
                                   :sync="true"
                                   :labels="true"
                                   @change="toggleActionHandler($event, action.id)">
                    </toggle-button>
                </b-col>
                <b-col sm="6">
                    <b-form-input
                            type="email"
                            :value="action.sender || getDefaultEmailSender"
                            @change.native="editActionSender($event, action.id)">
                    </b-form-input>
                </b-col>
            </b-row>
            <button class="btn btn-primary mr-2" @click="saveActions">Save</button>
            <span v-if="errorAction" class="text-danger">{{ errorAction }}</span>
            <span v-if="messageAction" class="text-success">{{ messageAction }}</span>
        </b-col>
    </div>
</template>

<script>
    import {mapState, mapGetters} from 'vuex'
    import ToggleButton from '../../Button'

    export default {
        name: "settings",
        created() {
            this.$store.dispatch('email/fetchAllSettings');
            this.$store.dispatch('email/fetchAllActions');
        },
        computed: {
            ...mapState('email', ['settings', 'actions', 'messageSetting', 'errorSetting', 'messageAction', 'errorAction']),
            ...mapGetters('email', ['getDefaultEmailSender'])
        },
        methods: {
            editSetting(event, id) {
                this.$store.dispatch('email/editSetting', {id: id, value: event.target.value});
            },
            saveSettings() {
                this.$store.dispatch('email/saveSettings');
            },
            toggleActionHandler(event, id) {
                this.$store.dispatch('email/toggleAction', {id: id, value: event.value});
            },
            editActionSender(event, id) {
                this.$store.dispatch('email/editActionSender', {id: id, value: event.target.value});
            },
            saveActions() {
                this.$store.dispatch('email/saveActions');
            }
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

<style scoped>
    h4 {
        color: #8a8484;
        font-weight: bold;
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