<template>
    <div>
        <h3 class="text-center">Main Dashboard</h3>

        <admin-dashboard-vue v-if="role == 'admin'"></admin-dashboard-vue>
        <business-dashboard-vue v-if="role == 'business'"></business-dashboard-vue>
    </div>
</template>

<script>

    export default {

        props: {
            'role': {
                type: String,
                default: ''
            }
        },

        //components: {AdminDashboard, BusinessDashboard},

        mixins: [],

        data() {
            return {
            }
        },

        computed: {},

        methods: {

        },

        mounted() {

        },

        watch: {},
    }
</script>

<style scoped>

</style>
