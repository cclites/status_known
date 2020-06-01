<template>
    <div>
        <b-card header=""
                header-text-variant="white"
                header-bg-variant="info"
        >
            <b-container>
                <b-row>
                    <b-col>
                        <date-filter :label="start" v-if="filters.includes('start')"></date-filter>
                    </b-col>
                    <b-col>
                        <date-filter :label="end" v-if="filters.includes('end')"></date-filter>
                    </b-col>
                    <b-col>
                        <business-filter v-if="filters.includes('business')"></business-filter>
                    </b-col>
                    <b-col>
                        <user-filter v-if="filters.includes('user')"></user-filter>
                    </b-col>

                </b-row>
            </b-container>
        </b-card>
    </div>

</template>

<script>
    import DateFilter from '../filters/DateFilter';
    import AccountFilter from '../filters/AccountFilter';
    import BusinessFilter from '../filters/BusinessFilter';
    import RecordFilter from '../filters/RecordFilter';
    import ReportFilter from '../filters/ReportFilter';
    import UserFilter from '../filters/UserFilter';

    export default {

        props: {
            filters: '', //represents an array of flags so app knows which
                         //filters to display
        },

        components: {DateFilter, AccountFilter, BusinessFilter, RecordFilter, ReportFilter, UserFilter},

        mixins: [],

        data() {
            return {
                selected: {
                    start_date: '',
                    end_date: '',
                    business: '',
                    record: '',
                    report: '',
                    user: '',
                    account: '',
                },
                start: 'start',
                end: 'end',
                show: false,
            }
        },

        computed: {},

        methods: {

            setFilters(){
                if( this.filters.includes("start")){

                    let startDate = moment().subtract(7, 'days').format("y-MM-DD");
                    console.log("Start date " + startDate);
                    //this.selected.start_date = startDate;

                    //this.selected_filters.start_date = startDate;
                    //selected_filters.start_date = startDate;
                }

                if( this.filters.includes("end")){

                    let endDate = moment().format("y-MM-DD");
                    console.log("End date " + endDate);
                }
            }

        },

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>
    .fieldset,
    .card{
        width: 100%;
    }
</style>
