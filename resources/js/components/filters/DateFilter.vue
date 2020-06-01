<template>
    <div>
        <b-form-group :label="date_label">
            <b-form-datepicker v-model="init_date"></b-form-datepicker>
        </b-form-group>
    </div>
</template>

<script>

    export default {

        props: {
            label: ''
        },

        components: {},

        mixins: [],

        data() {
            return {
                start_date_label: "Start Date",
                end_date_label: "End Date",
                start_date: moment().subtract(7, 'days').format("y-MM-DD"),
                end_date: moment().format("y-MM-DD")
            }
        },

        computed: {
            date_label(){
                return this.label === 'start' ? this.start_date_label : this.end_date_label;
            },

            init_date(){
                return this.label === 'start' ? this.start_date : this.end_date;
            }
        },

        methods: {},

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>

</style>
