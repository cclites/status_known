<template>
    <div>
        <h4 class="text-center">Admin Dashboard</h4>
        <b-tabs>
            <b-tab title="Businesses" active>
                <business-view></business-view>
            </b-tab>
            <b-tab title="Reports">
                <reports-view></reports-view>
            </b-tab>
            <b-tab title="Users">
                <users-view></users-view>
            </b-tab>
            <b-tab title="Invoices">
                <invoices-view></invoices-view>
            </b-tab>
            <b-tab title="Accounts">
                <accounts-view></accounts-view>
            </b-tab>

        </b-tabs>
    </div>

</template>

<script>

    import BusinessView from "../views/BusinessView";
    import ChecksView from "./ChecksView";
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
