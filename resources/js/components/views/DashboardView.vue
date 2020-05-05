<template>
    <div>
        <h3 class="text-center">Main Dashboard</h3>

        <admin-dashboard-vue v-if="this.role == 'admin'"></admin-dashboard-vue>
        <business-dashboard-vue v-if="this.role == 'business'" roles="userObj.roles" permissions="'userObject.permissions"></business-dashboard-vue>

    </div>
</template>

<script>

    export default {

        props: {
            'user': ''
        },

        mixins: [],

        data() {
            return {
                role: '',
                userObj: {}
            }
        },

        computed: {},

        methods: {
            setRole(){
                this.role = this.userObj.roles[0].name;
            },
        },

        mounted() {
            this.userObj = JSON.parse(this.user);
            this.setRole()
        },

        watch: {},
    }
</script>

<style scoped>

</style>
