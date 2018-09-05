<template>
    <div class="mt-3 mx-2">
        <h4 class="pl-5 mt-5">{{ templateEditable.name }}</h4>
        <div class="line"></div>
        <b-row class="my-3">
            <!--Email Header-->
            <b-col sm="9">
                <div class="dashed p-3">
                    <b-row>
                        <b-col sm="4">
                            <div class="logo-img">
                                <img :src= "emailLogo ? emailLogo : templateEditable.headerImage ? '/images/email/' + templateEditable.headerImage : '/images/email/default-email-logo.png'"
                                     class="img-fluid email-logo" alt="email-logo">
                                <div class="upload-btn">
                                    <label for="logoInput" class="btn btn-primary btn-lg"><i class="fas fa-upload"></i> Upload</label>
                                    <input type="file" name="logoInput" id="logoInput" @change="logoHandle"/>
                                </div>
                            </div>
                        </b-col>
                        <b-col sm="8">
                            <div class="text-title">
                                <input class="p-3"
                                       type="text"
                                       :readonly="true"
                                       placeholder="TITLE TEXT"
                                       :value="templateEditable.headerTitle"
                                       ref="title"
                                       @focus="titleEdit"
                                       @blur="loseTitleFocus"
                                       @input="titleTextHandle">
                                <span class="pen" @click="titleEdit"><i class="fas fa-pen"></i></span>
                            </div>
                        </b-col>
                    </b-row>
                </div>
            </b-col>
            <!--Email Sidebar-->
            <b-col sm="3">
                <div class="dashed p-3 h-100">
                    <p>Placeholders:</p>
                    <p>Background color:</p>
                </div>
            </b-col>
        </b-row>
        <button class="btn btn-success" @click="saveTemplate">Save</button>
        <button class="btn btn-warning" @click="cancelEdit">Cancel</button>
    </div>
</template>

<script>
    import {mapState} from 'vuex'

    export default {
        name: "editor",
        data() {
            return {
                emailLogo: null,
                logo: null
            }
        },
        computed: {
            ...mapState('emailTemplates', ['templateEditable'])
        },
        methods: {
            logoHandle(event) {
                let files = event.target.files;
                if (files && files[0]) {
                    let reader = new FileReader();
                    reader.onload = e => {
                        this.emailLogo = e.target.result;
                    };
                    reader.readAsDataURL(files[0]);
                    this.logo = files[0];

                } else {
                    this.emailLogo = null;
                    this.logo = null;
                }
            },
            titleEdit() {
                this.$refs.title.removeAttribute('readonly');
                this.$refs.title.focus()
            },
            loseTitleFocus() {
                this.$refs.title.setAttribute('readonly', true);
            },
            titleTextHandle(event) {
                this.$store.dispatch('emailTemplates/editTitleText', event.target.value);
            },
            saveTemplate() {
                this.$store.dispatch('emailTemplates/saveTemplate', this.logo);
                this.$emit('save');
            },
            cancelEdit() {
                this.$emit('close');
            },
        }
    }
</script>

<style scoped>
    .dashed {
        border: 1px dashed #e6e5e5;
        height: auto;
    }

    input#logoInput[type="file"] {
        display: none;
    }

    .logo-img {
        position: relative;
        height: auto;
        max-width: 200px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 10px;
    }

    .logo-img:hover .upload-btn {
        opacity: 1;
    }

    .email-logo {
        max-width: 200px;
    }

    .upload-btn {
        position: absolute;
        display: flex;
        opacity: 0;
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .4);
        transition: opacity 200ms linear;
    }

    .text-title {
        position: relative;
        max-width: 100%;
        display: flex;
        width: 100%;
        height: 100%;
        align-items: center;
        justify-content: center;
    }

    .text-title input {
        width: 100%;
        text-align: center;
        font-weight: bold;
        border: 1.5px dashed #e6e5e5;
        cursor: default;
    }

    .pen {
        position: absolute;
        right: 10%;
        cursor: pointer;
    }

</style>