<template>
    <admin-dashboard-vue v-if="role.admin"></admin-dashboard-vue>
    <business-dashboard-vue v-else-if="role.business"></business-dashboard-vue>

</template>

<script>
    //import AdminDashboard from './components/views/AdminDashboard';
    import AdminDashboard from 'views/AdminDashboard.vue';
    import BusinessDashboard from 'views/BusinessDashboard.vue';

    export default {

        props: {
            'auth': {
                type: Object,
                default: function(){
                    return {}
                }
            }
        },

        components: {AdminDashboard, BusinessDashboard},

        mixins: [],

        data() {
            return {
                role: {
                    admin: true,
                    business: true
                },
            }
        },

        computed: {},

        methods: {

        },

        mounted() {
            //TODO: Get auth-user role
            console.log(JSON.stringify(this.auth));
        },

        watch: {},
    }
</script>

<style scoped>

</style>
