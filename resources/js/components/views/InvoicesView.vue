<template>
    <div>
        <b-table striped hover :items="items"></b-table>
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
            }
        },

        computed: {},

        methods: {
            getInvoices() {
                axios.get(this.url)
                    .then((response) => {
                        this.items = response.data;
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
