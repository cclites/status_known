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
                url: 'checks-view',
                items: [],
            }
        },

        computed: {},

        methods: {
            getReports() {
                axios.get(this.url)
                    .then((response) => {
                        this.items = response.data;
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
