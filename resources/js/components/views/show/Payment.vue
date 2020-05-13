<template>
    <div>
        <b-row>
            <b-card :header="header"
                    header-text-variant="white"
                    header-bg-variant="info"
            >
                <h3 class="text-center">Payment Model View</h3>

                <draft-model-show :model="payment"></draft-model-show>

            </b-card>
        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            payment: {
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
                header: "Payment #" . this.payment.id,
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
