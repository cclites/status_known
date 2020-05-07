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
                url: 'business-view',
                items: [],
            }
        },

        computed: {},

        methods: {
            getBusinesses(){
                axios.get(this.url)
                    .then((response) => {
                        this.items = response.data;
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
