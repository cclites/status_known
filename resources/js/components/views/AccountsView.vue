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
                url: 'accounts-view',
                rows: '',
                currentPage: 1,
                perPage: 10,
                fields: [
                    {
                        label: 'Business',
                        key: 'business_name',
                        sortable: true
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
                ]
            }
        },

        computed: {},


        methods: {
            getAccounts() {
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
            this.getAccounts();
        },

        watch: {},
    }
</script>

<style scoped>

</style>
