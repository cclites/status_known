<template>
    <div>
        <b-overlay :show="show" rounded="sm">

            <record-count :records="this.items.length"></record-count>

            <filters-component :filters="filters" :filter-type="user"></filters-component>

            <b-table striped hover
                     :items="items"
                     :per-page="perPage"
                     :current-page="currentPage"
                     :fields="fields"
                     @row-clicked="showUser"
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
                        label: 'Name',
                        key: 'name',
                        sortable: true
                    },
                    {
                        label: 'Email',
                        key: 'email',
                        sortable: true
                    },
                    {
                        label: 'Started',
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
                url: 'users-view/',
                reportUrl : 'users/',
                filters: ['user'],
                params: '',
                user: 'user',
            }
        },

        computed: {},

        methods: {

            getUsers() {
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

            showUser(row){
                window.location = this.reportUrl + row.user_id;
            },

            getFilteredResults(){

                axios.get(this.url, {
                        params: this.params
                    })
                    .then((response) => {
                        this.items = response.data;
                        this.rows = this.items.length;
                        this.show = false;
                        this.$emit('CLEAR_SELECTED_EVENT', true);
                    }, (error) => {
                        console.log(error);
                    });
            },

        },

        mounted() {

            this.getUsers();

            EventBus.$on('UPDATE_USERS', (payload) => {

                console.log('USER FILTER EVENT HAS BEEN CALLED. SHOW PARAMS: ' + "\n");
                this.params = payload;
                console.log(payload);

                this.getFilteredResults();
            });
        },

        watch: {},
    }
</script>

<style scoped>

</style>
