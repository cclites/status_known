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
                url: 'users-view',
                rows: '',
                currentPage: 1,
                perPage: 10,
                fields: [
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
            }
        },

        computed: {},

        methods: {
            getUsers() {
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
            this.getUsers();
        },

        watch: {},
    }
</script>

<style scoped>

</style>
