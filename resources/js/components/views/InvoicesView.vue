<template>
    <div>
        <b-table striped hover
                 :items="items"
                 :per-page="perPage"
                 :current-page="currentPage"
                 :fields="fields"
        >
        </b-table>

        <b-pagination
            v-if="rows>perPage"
            v-model="currentPage"
            :total-rows="rows"
            :per-page="perPage"
            first-text="⏮"
            prev-text="⏪"
            next-text="⏩"
            last-text="⏭"
            class="mt-4"

        ></b-pagination>
    </div>
</template>

<script>

    export default {

        props: {},

        components: {},

        mixins: [],

        data() {
            return {
                items: [],
                url: 'invoices-view',
                rows: '',
                currentPage: 1,
                perPage: 10,
                fields: [
                    {
                        label: 'Invoice Id',
                        key: 'id',
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
                ]
            }
        },

        computed: {},

        methods: {
            getInvoices() {
                axios.get(this.url)
                    .then((response) => {
                        this.items = response.data;
                        this.rows = this.items.length;
                    }, (error) => {
                        console.log(error);
                    });
            }
        },

        mounted() {
            this.getInvoices();
        },

        watch: {},
    }
</script>

<style scoped>

</style>
