<template>
    <div>
        <b-row>
            <b-card :header="header"
                    header-text-variant="white"
                    header-bg-variant="info"
            >
                <h3 class="text-center">Provider Model View</h3>

                <draft-model-show :model="provider"></draft-model-show>

            </b-card>
        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            provider: {
                type: Object,
                default: function() {
                    return {}
                }
            }
        },

        components: {},

        mixins: [],

        data() {
            return {
                header: this.provider.name
            }
        },

        computed: {},

        methods: {},

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>

</style>
