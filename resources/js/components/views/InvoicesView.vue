<template>
    <div>
        <b-overlay :show="show" rounded="sm">

            <record-count :records="this.items.length"></record-count>

            <filters-component :filters="filters" :filter-type="invoice"></filters-component>

            <b-table striped hover
                     :items="items"
                     :per-page="perPage"
                     :current-page="currentPage"
                     :fields="fields"
                     @row-clicked="showInvoice"
            >
            </b-table>

            <pagination
                :rows = "this.items.length"
                :perPage="this.perPage"
                :currentPage="this.currentPage"
            >
            </pagination>
        </b-overlay>
    </div>
</template>

<script>

    import pagination from '../utilities/Pagination';
    import record_count from '../utilities/RecordCount';
    import FilterView from '../filters/Filters';
    import EventBus from "../../classes/eventBus";

    export default {

        props: {
            role: ''
        },

        components: {pagination, record_count},

        mixins: [],

        data() {
            return {
                items: [],
                rows: '',
                currentPage: 1,
                perPage: 10,
                fields: [
                    {
                        label: 'Business',
                        key: 'business_name',
                        sortable: true,
                        thClass: this.role !== 'admin' ? 'd-none' : '',
                        tdClass: this.role !== 'admin' ? 'd-none' : '',
                    },
                    {
                        label: 'For',
                        key: 'record_name',
                        sortable: true
                    },
                    {
                        label: 'Invoice Id',
                        key: 'invoice_id',
                        sortable: true
                    },
                    {
                        label: 'Amount',
                        key: 'amount',
                        sortable: true
                    },
                    {
                        label: 'Created',
                        key: 'created_at',
                        sortable: true
                    },
                ],
                show: false,
                url: 'invoices-view/',
                reportUrl : 'invoices/',
                invoice: 'invoice',
                filters: ['start', 'end', 'business'],
                params: ''
            }
        },

        computed: {},

        methods: {
            getInvoices()
            {
                this.show = true;
                axios.get(this.url)
                    .then((response) => {
                        this.items = response.data;
                        this.rows = this.items.length;
                        this.show = false;
                    }, (error) => {
                        console.log(error);
                    });
            },

            showInvoice(row){

                //let reportId = row.report_id;
                window.location = this.reportUrl + row.invoice_id;

                //This for testing only. Would really do a download here.
                //window.location = this.reportUrl + row.report_id
                /*
                axios.get(this.reportUrl + row.invoice_id)
                    .then((response) => {
                        console.log(response);
                    }, (error) => {
                        console.log(error);
                    });*/
            },

            getFilteredResults(){

                axios.get(this.url, {
                    params: this.params
                })
                    .then((response) => {
                        this.items = response.data;
                        this.rows = this.items.length;
                        this.show = false;
                    }, (error) => {
                        console.log(error);
                    });
            },
        },

        mounted() {
            this.getInvoices();

            EventBus.$on('UPDATE_INVOICES', (payload) => {

                this.params = payload;
                console.log(JSON.stringify(payload));

                this.getFilteredResults();
            });
        },

        watch: {},
    }
</script>

<style scoped>

</style>
