<template>
    <div>
        <b-row>
            <business-show :business="business"></business-show>
        </b-row>

        <hr>

        <b-row>
            <addresses-show :addresses="business['addresses'] || []"></addresses-show>
        </b-row>

        <hr>

        <b-row>
            <phone-numbers-show :phone_numbers="business.phone_numbers || []"></phone-numbers-show>
        </b-row>
    </div>

</template>

<script>

    export default {

        props: {
            business: {
                type: Object,
                default: function(){
                    return {};
                }
            }
        },

        components: {},

        mixins: [],

        data() {
            return {}
        },

        computed: {},

        methods: {},

        mounted() {

            //console.log( JSON.stringify(this.business) );
        },

        watch: {},
    }
</script>

<style scoped>

</style>
