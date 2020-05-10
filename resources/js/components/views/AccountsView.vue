<template>
    <div>
        <b-overlay :show="show" rounded="sm">

            <record-count :records="this.items.length"></record-count>

            <b-table striped hover
                     :items="items"
                     :per-page="perPage"
                     :current-page="currentPage"
                     :fields="fields"
                     @row-clicked="showAccount"
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
                        label: 'Account Number',
                        key: 'account_number',
                        sortable: true
                    },
                    {
                        label: 'Account Name',
                        key: 'account_name',
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
                url: 'accounts-view/',
                reportUrl : 'accounts/',
            }
        },

        computed: {},


        methods: {
            getAccounts() {

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

            showAccount(row){

                this.show = true;

                axios.get(this.reportUrl + row.account_id)
                    .then((response) => {
                        console.log(response);

                        this.show = false;
                    }, (error) => {
                        console.log(error);
                    });
            }
        },

        mounted() {
            this.getAccounts();
        },

        watch: {},
    }
</script>

<style scoped>

</style>
