<template>
    <div>
        <b-row>
            <b-card :header="header"
                    header-text-variant="white"
                    header-bg-variant="info"
            >
                <h3 class="text-center">Record Model View</h3>

                <draft-model-show :model="record"></draft-model-show>

                <div>
                    <b-button variant="outline-primary" class="text-right">Print</b-button>
                    <b-button variant="outline-secondary">Update</b-button>
                </div>
            </b-card>
        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            record: {
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
