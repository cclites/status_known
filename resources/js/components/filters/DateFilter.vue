<template>
    <div>
        <b-form-group :label="date_label">
            <!--b-form-datepicker v-model="init_date" @keyup="emit"></b-form-datepicker-->
            <b-form-input type="date" v-model="init_date" @change="emit"></b-form-input>
        </b-form-group>
    </div>
</template>

<script>

    import EventBus from "../../classes/eventBus";

    export default {

        props: {
            label: ''
        },

        components: {},

        mixins: [],

        data() {
            return {
                start_date_label: "Select Start Date",
                end_date_label: "Select End Date",
                start_date: moment().subtract(7, 'days').format("y-MM-DD"),
                end_date: moment().format("y-MM-DD"),
                start_event: 'START_FILTER_EVENT',
                end_event: 'END_FILTER_EVENT',
                init_date: '',
            }
        },

        computed: {
            date_label(){
                return this.label === 'start' ? this.start_date_label : this.end_date_label;
            },
        },

        methods: {
            emit(){
                if( this.label === 'start' ){
                    console.log("Emit start filter event");
                    EventBus.$emit('START_FILTER_EVENT', this.init_date);
                }else{

                    console.log("Emit end filter event");
                    EventBus.$emit('END_FILTER_EVENT', this.init_date);
                }
            }
        },

        mounted() {
            this.init_date = (this.label === 'start') ? this.start_date : this.end_date;
        },

        watch: {},
    }
</script>

<style scoped>

</style>
