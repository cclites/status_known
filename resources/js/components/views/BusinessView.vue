<template>
    <div>
        <b-overlay :show="show" rounded="sm">

            <record-count :records="this.items.length"></record-count>

            <filters-component :filters="filters" :filter-type="business"></filters-component>

            <b-table striped hover
                     :items="items"
                     :per-page="perPage"
                     :current-page="currentPage"
                     :fields="fields"
                     @row-clicked="showBusiness"
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

    import Pagination from '../utilities/Pagination';
    import RecordCount from '../utilities/RecordCount';
    import FilterView from '../filters/Filters';
    import EventBus from "../../classes/eventBus";

    export default {

        props: {
            role: ''
        },

        components: {Pagination, RecordCount, FilterView},

        mixins: [],

        data() {
            return {
                items: [],
                rows: '',
                currentPage: 1,
                perPage: 10,
                fields: [
                    {
                        label: 'Business Name',
                        key: 'business_name',
                        sortable: true,
                        thClass: this.role !== 'admin' ? 'd-none' : '',
                        tdClass: this.role !== 'admin' ? 'd-none' : '',
                    },
                    {
                        label: 'Responsible Agent',
                        key: 'responsible_agent',
                        sortable: true
                    },
                    {
                        label: 'Responsible Agent Email',
                        key: 'responsible_agent_email',
                        sortable: true
                    },
                    {
                        label: 'Business Address',
                        key: 'formatted_address',
                        sortable: true
                    },
                    {
                        label: 'Business Phone',
                        key: 'business_phone',
                        sortable: true
                    },
                    {
                        label: 'Business Email',
                        key: 'business_email',
                        sortable: true
                    },
                    {
                        label: 'Since',
                        key: 'created_at',
                        sortable: true
                    },
                    {
                        label: 'Active',
                        key: 'active',
                        sortable: true
                    },
                ],
                show: false,
                url: 'business-view/',
                reportUrl : 'businesses/',
                filters: ['business'],
                params: '',
                business: 'business'
            }
        },

        computed: {},

        methods: {
            getBusinesses(){

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

            showBusiness(row){

                window.location = this.reportUrl + row.business_id;

                //let reportId = row.report_id;
                //console.log(row.business_id);

                //This for testing only. Would really do a download here.
                //window.location = this.reportUrl + row.report_id
                /*
                axios.get(this.reportUrl + row.business_id)
                    .then((response) => {
                        console.log(response);
                    }, (error) => {
                        console.log(error);
                    });*/
            },

            getFilteredResults(){

                axios.get(this.url, {
                    params: {
                        business: this.params.business,
                    }
                })

                    .then((response) => {
                        this.items = response.data;
                        this.rows = this.items.length;
                        this.show = false;
                        this.$emit('CLEAR_SELECTED_EVENT', true);

                    }, (error) => {
                        console.log(error);
                    });

            }

        },

        mounted() {

            this.getBusinesses();

            EventBus.$on('UPDATE_BUSINESSES', (payload) => {

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
