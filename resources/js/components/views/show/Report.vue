<template>
    <div>
        <b-row>
            <b-card :header="header"
                    header-text-variant="white"
                    header-bg-variant="info"
            >
                <h3 class="text-center">Report Model View</h3>

                <draft-model-show :model="report"></draft-model-show>
            </b-card>
        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            report: {
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
                header: ""
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
