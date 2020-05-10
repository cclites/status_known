<template>
    <div>
        <b-overlay :show="show" rounded="sm">

            <record-count :records="this.items.length"></record-count>

            <b-table striped hover
                     :items="items"
                     :per-page="perPage"
                     :current-page="currentPage"
                     :fields="fields"
            >
            </b-table>

            <pagination
                :rows = "this.items.length"
                :perPage="this.perPage"
                :currentPage="this.currentPage"
                @row-clicked="showPayment"
            >
            </pagination>
        </b-overlay>
    </div>
</template>

<script>

    import pagination from '../utilities/Pagination';
    import record_count from '../utilities/RecordCount';

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
                        label: 'Account Number',
                        key: 'account_number',
                        sortable: true
                    },
                    {
                        label: 'Card Number',
                        key: 'card_number',
                        sortable: true
                    },
                    {
                        label: 'Added',
                        key: 'created_at',
                        sortable: true
                    },
                    {
                        label: 'Updated',
                        key: 'updated_at',
                        sortable: true
                    },
                ],
                show: false,
                url: 'payments-view/',
                reportUrl : 'payments/',
            }
        },

        computed: {},


        methods: {
            getPayments() {

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

            showPayment(row){

                window.location = this.reportUrl + row.payment_id;

                //let reportId = row.report_id;

                //This for testing only. Would really do a download here.
                //window.location = this.reportUrl + row.report_id
                /*
                axios.get(this.reportUrl + row.payment_id)
                    .then((response) => {
                        console.log(response);
                    }, (error) => {
                        console.log(error);
                    });*/
            }
        },

        mounted() {
            this.getPayments();
        },

        watch: {},
    }
</script>

<style scoped>

</style>
