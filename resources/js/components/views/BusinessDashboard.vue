<template>
    <div class="rows">
        Admin Dashboard Users
        <ul>
            <li>Reports</li>
            <li>Users</li>
            <li>Invoices</li>
            <li>Accounts</li>
        </ul>

        <reports-view></reports-view>

        <users-view></users-view>

        <invoices-view></invoices-view>

        <accounts-view></accounts-view>

    </div>



</template>

<script>

    import AccountsView from "../views/AccountsView";
    import ReportsView from "../views/ReportsView";
    import UsersView from "../views/UsersView";
    import InvoicesView from "../views/InvoicesView";

    export default {

        props: {
        },

        components: {InvoicesView, ReportsView, UsersView, AccountsView},

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
