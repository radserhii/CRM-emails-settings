<template>
    <div class="container-fluid mt-1">
        <b-card no-body>
            <b-tabs card>
                <b-tab active>
                    <template slot="title">
                        <i class="fa fa-cog"> SETTINGS</i>
                    </template>
                    <email-settings></email-settings>
                </b-tab>
                <b-tab>
                    <template slot="title">
                        <i class="fa fa-clone"> TEMPLATES</i>
                    </template>
                    <email-templates></email-templates>
                </b-tab>
            </b-tabs>
        </b-card>
    </div>
</template>

<script>
    import EmailSettings from './settings';
    import EmailTemplates from './templates';

    export default {
        name: "index",
        components: {
            EmailSettings,
            EmailTemplates
        }
    }
</script>

<style scoped>

</style>