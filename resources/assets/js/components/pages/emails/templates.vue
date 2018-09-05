<template>
    <div class="mt-3 mx-5">
        <template v-if="!editor && !preview" v-for="template in templates">
            <b-row align-v="center" class="mt-3">
                <b-col sm="3" class="pl-5"><b><i class="far fa-envelope-open"></i> {{ template.name }}</b></b-col>
                <b-col sm="5"></b-col>
                <b-col sm="4" class="text-center">
                    <button class="btn btn-primary mr-2" @click="">View</button>
                    <button class="btn btn-primary mr-2" @click="showEditor(template)">Edit</button>
                    <toggle-button :value="getToggleValue(template)"
                                   color="#82C7EB"
                                   :sync="true"
                                   :labels="true"
                                   @change="toggleActionHandler($event, template)">
                    </toggle-button>
                </b-col>
            </b-row>
            <div class="line"></div>
        </template>
        <editor v-if="editor" @close="closeEditor" @save="saveEditor"></editor>
    </div>
</template>

<script>
    import {mapState} from 'vuex'
    import ToggleButton from '../../common/Button'
    import Editor from './editor';

    export default {
        name: "templates",
        data() {
            return {
                editor: false,
                preview: false,
            }
        },
        created() {
            this.$store.dispatch('emailTemplates/fetchAllTemplates');
        },
        computed: {
            ...mapState('emailTemplates', ['templates', 'errorTemplate']),
            ...mapState('emailSettings', ['actions']),
        },
        methods: {
            getToggleValue(template) {
                let action = this.actions.find((action) => {
                    return action.id === template.actionId;
                });
                return action.enabled;
            },
            toggleActionHandler(event, template) {
                this.$store.dispatch('emailSettings/toggleAction', {id: template.actionId, value: event.value});
                this.saveActions();
            },
            saveActions() {
                this.$store.dispatch('emailSettings/saveActions');
            },
            showEditor(template) {
                this.$store.dispatch('emailTemplates/setTemplateEditable', template);
                this.editor = true;
            },
            closeEditor() {
                this.$store.dispatch('emailTemplates/fetchAllTemplates');
                this.editor = false
            },
            saveEditor() {
                this.editor = false;
            }
        },
        components: {
            ToggleButton,
            Editor
        }
    }
</script>

<style scoped>
    .line {
        border-top: 2px solid #e6e5e5;
        margin-top: 10px;
        width: 100%;
        position: relative;
    }
</style>