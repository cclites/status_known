<template>
    <div>
        Admin Dashboard Users

        <ul>
            <li>Reports</li>
            <li>Businesses</li>
            <li>Users</li>
            <li>Invoices</li>
            <li>Accounts</li>
        </ul>

        <checks-view></checks-view>
        <business-view></business-view>

        <users-view></users-view>
        <invoices-view></invoices-view>
        <accounts-view></accounts-view>


    </div>

</template>

<script>

    import BusinessView from "../views/BusinessView";
    import ChecksView from "../views/ChecksView";
    import ReportsView from "../views/ReportsView";
    import UsersView from "../views/UsersView";
    import AccountsView from "../views/AccountsView";

    export default {
        props: {
            permissions: ''
        },

        components: {BusinessView, ChecksView, ReportsView, UsersView, AccountsView},

        mixins: [],

        data() {
            return {}
        },

        computed: {},

        methods: {},

        mounted() {
        },

        watch: {},
    }
</script>

<style scoped>

</style>
