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
                url: 'business-view',
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
                show: false
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
        },

        mounted() {
            this.getBusinesses();
        },

        watch: {},
    }
</script>

<style scoped>

</style>
