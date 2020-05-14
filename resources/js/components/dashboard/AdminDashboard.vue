<template>
    <div>
        <h4 class="text-center">Admin Dashboard</h4>
        <b-tabs>
            <b-tab title="Businesses" active>
                <business-view :role="role"></business-view>
            </b-tab>
            <b-tab title="Reports">
                <reports-view :role="role"></reports-view>
            </b-tab>
            <b-tab title="Records">
                <records-view :role="role"></records-view>
            </b-tab>
            <b-tab title="Users">
                <users-view :role="role"></users-view>
            </b-tab>
            <b-tab title="Invoices">
                <invoices-view :role="role"></invoices-view>
            </b-tab>
            <b-tab title="Accounts">
                <accounts-view :role="role"></accounts-view>
            </b-tab>

        </b-tabs>
    </div>

</template>

<script>

    import BusinessView from "../views/BusinessView";
    import ReportsView from "../views/ReportsView";
    import UsersView from "../views/UsersView";
    import AccountsView from "../views/AccountsView";
    import InvoicesView from "../views/InvoicesView";
    import PaymentsView from "../views/PaymentsView";

    export default {
        props: {
            role: ''
        },

        components: {BusinessView, ReportsView, UsersView, AccountsView, InvoicesView, PaymentsView},

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
