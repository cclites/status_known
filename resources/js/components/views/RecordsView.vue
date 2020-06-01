<template>
    <div>
        <b-overlay :show="show" rounded="sm">

            <record-count :records="this.items.length"></record-count>

            <filters-component :filters="filters" :filter-type="record"></filters-component>

            <b-table striped hover
                     :items="items"
                     :per-page="perPage"
                     :current-page="currentPage"
                     :fields="fields"
                     @row-clicked="showRecord"
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
                reportUrl : 'records/',
                url: 'records-view/',
                filters: ['start', 'end', 'business'],
                params: '',
                record: 'record',
            }
        },

        computed: {
        },

        methods: {

            getRecords() {

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

            showRecord(row){
                window.location = this.reportUrl + row.record_id;
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
            this.getRecords();

            EventBus.$on('UPDATE_RECORDS', (payload) => {
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
