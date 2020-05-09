<template>
    <div>
        <b-overlay :show="show" rounded="sm">

            <record-count :records="this.items.length"></record-count>

            <b-table striped hover
                     :items="items"
                     :per-page="perPage"
                     :current-page="currentPage"
                     :fields="fields"
                     @row-clicked="showReport"
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
                        label: 'Report Id',
                        key: 'report_id',
                        sortable: true
                    },
                    {
                        label: 'Requested By',
                        key: 'requested_by',
                        sortable: true
                    },
                    {
                        label: 'Requested For',
                        key: 'requested_for',
                        sortable: true
                    },
                    {
                        label: 'Request Date',
                        key: 'request_date',
                        sortable: true
                    },
                    {
                        label: 'Completion Date',
                        key: 'completion_date',
                        sortable: true
                    },
                ],
                show: false,
                reportUrl : 'reports/',
                url: 'reports-view/',
            }
        },

        computed: {
        },

        methods: {

            getReports() {

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

            showReport(row){

                let reportId = row.report_id;

                //This for testing only. Would really do a download here.
                //window.location = this.reportUrl + row.report_id
                axios.get(this.reportUrl + row.report_id)
                    .then((response) => {
                        console.log(response);
                    }, (error) => {
                        console.log(error);
                    });
            }
        },

        mounted() {
            this.getReports();
        },

        watch: {},
    }
</script>

<style scoped>

</style>
