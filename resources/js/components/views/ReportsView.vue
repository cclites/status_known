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
                url: 'reports-view',
                items: [],
                rows: '',
                currentPage: 1,
                perPage: 10,
                fields: [
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
            }
        },

        computed: {},

        methods: {
            getReports() {
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
            this.getReports();
        },

        watch: {},
    }
</script>

<style scoped>

</style>
