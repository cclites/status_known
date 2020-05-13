<template>
    <div>
        <b-row>
            <b-card :header="header"
                    header-text-variant="white"
                    header-bg-variant="info"
            >
                <h3 class="text-center">Invoice Model View</h3>

                <draft-model-show :model="invoice"></draft-model-show>

            </b-card>
        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            invoice: {
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
                header: 'Invoice #' . this.invoice.id
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
