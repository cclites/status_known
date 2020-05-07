<template>
    <div>
        <admin-dashboard-vue v-if="this.role == 'admin'"></admin-dashboard-vue>
        <business-dashboard-vue v-else-if="this.role == 'business'"></business-dashboard-vue>

        <div v-else>
            <h4 class="text-center mt-5">
                You have not yet been given permission to use this app. Please contact your manager
                or your representative for further details.
            </h4>
        </div>
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
