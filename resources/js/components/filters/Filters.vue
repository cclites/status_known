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
                    <b-col>
                        <button class="btn btn-outline-success" @click="getFiltered">Search</button>
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

    import EventBus from '../../classes/eventBus';

    export default {

        props: {
            filters: '', //represents an array of flags so app knows which
                         //filters to display
            filterType: '',
        },

        components: {DateFilter, AccountFilter, BusinessFilter, RecordFilter, ReportFilter, UserFilter},

        mixins: [],

        data() {
            return {
                selected: {
                    start_date: moment().subtract(7, 'days').format("y-MM-DD"),
                    end_date: moment().format("y-MM-DD"),
                    business: '',
                    record: '',
                    report: '',
                    invoice: '',
                    user: '',
                    account: '',
                    list_type: '', //users, records, invoices, accounts, etc.
                },
                start: 'start',
                end: 'end',
                show: false,
            }
        },

        computed: {},

        methods: {

            //emit back to parent
            emitFilters(){

                if (this.selected.list_type === 'user'){
                    EventBus.$emit('USER_FILTERED_EVENT', this.selected);
                }

                if (this.selected.list_type === 'business'){
                    EventBus.$emit('BUSINESS_FILTERED_EVENT', this.selected);
                }

                if (this.selected.list_type === 'record'){
                    EventBus.$emit('RECORD_FILTERED_EVENT', this.selected);
                }

                if (this.selected.list_type === 'invoice'){
                    EventBus.$emit('INVOICE_FILTERED_EVENT', this.selected);
                }
            },

            clearSelected(){

                console.log("Clearing selected");

                this.selected.start_date = moment().subtract(7, 'days').format("y-MM-DD");
                this.selected.end_date = moment().format("y-MM-DD");
                this.selected.business = '';
                this.selected.record = '';
                this.selected.report = '';
                this.selected.user = '';
                this.selected.account = '';
                this.selected.list_type = '';

            },

            getFiltered(){
                console.log("IN GETTING FILTERED\n");
                console.log("Need to make sure there is a selected list type.");
                console.log(this.filterType);

                if (this.filterType === 'user'){
                    EventBus.$emit('UPDATE_USERS', this.selected);
                }

                if (this.filterType === 'business'){
                    EventBus.$emit('UPDATE_BUSINESSES', this.selected);
                }

                if (this.filterType === 'record'){
                    EventBus.$emit('UPDATE_RECORDS', this.selected);
                }

                if (this.filterType === 'invoice'){
                    EventBus.$emit('UPDATE_INVOICES', this.selected);
                }
            }

        },

        mounted() {

            /*** THESE UPDATED THE 'selected' object. **/

            if( this.filters.includes('start') ){
                EventBus.$on('START_FILTER_EVENT', (start_date) => {
                    this.selected.start_date = start_date;
                });
            }

            if( this.filters.includes('end') ){
                EventBus.$on('END_FILTER_EVENT', (end_date) => {
                    this.selected.end_date = end_date;
                });
            }

            if( this.filters.includes('user') ){
                EventBus.$on('USER_FILTER_EVENT', (user_id) => {
                    this.selected.user = user_id;
                });
            }

            if( this.filters.includes('business') ){
                EventBus.$on('BUSINESS_FILTER_EVENT', (business_id) => {
                    this.selected.business = business_id;
                });
            }

            if( this.filters.includes('record') ){
                EventBus.$on('RECORD_FILTER_EVENT', (record_id) => {
                    this.selected.record = record_id;
                });
            }

            if( this.filters.includes('invoice') ){
                EventBus.$on('INVOICE_FILTER_EVENT', (invoice_id) => {
                    this.selected.invoice = invoice_id;
                });
            }

            if( this.filters.includes('account') ){
                EventBus.$on('ACCOUNT_FILTER_EVENT', (account_id) => {
                    this.selected.invoice = account_id;
                });
            }



            /*
            EventBus.$on('CLEAR_SELECTED_EVENT', (payload) => {
                console.log("Clearing selected event\n");
            });

            EventBus.$on('UPDATE_USER_EVENT', (payload) => {
                console.log("Clearing selected event\n");
            });*/


        },

        watch: {},
    }
</script>

<style scoped>
    .fieldset,
    .card{
        width: 100%;
    }

    .btn-outline-success {
        position: relative;
        right: 0;
        top: 28px;
    }
</style>
