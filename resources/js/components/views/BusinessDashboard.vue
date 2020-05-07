<template>
    <div class="rows">
        <b-tabs>
            <b-tab title="Reports" active>
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

    import AccountsView from "../views/AccountsView";
    import ReportsView from "../views/ReportsView";
    import UsersView from "../views/UsersView";
    import InvoicesView from "../views/InvoicesView";

    export default {

        props: {
            roles: [],
            permissions: [],
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
