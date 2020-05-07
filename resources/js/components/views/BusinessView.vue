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
                url: 'business-view',
                items: [],
                rows: '',
                currentPage: 1,
                perPage: 10,
                fields: [
                    {
                        label: 'Business Name',
                        key: 'business_name',
                        sortable: true
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
                ]
            }
        },

        computed: {},

        methods: {
            getBusinesses(){
                axios.get(this.url)
                    .then((response) => {
                        this.items = response.data;
                        this.rows = this.items.length;
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
