<template>
    <div class="rows">
        <h4 class="text-center">Business Dashboard</h4>
        <b-tabs>
            <b-tab title="Reports" active>
                <reports-view :role="role"></reports-view>
            </b-tab>
            <b-tab title="Invoices">
                <invoices-view :role="role"></invoices-view>
            </b-tab>
            <b-tab title="Users">
                <users-view :role="role"></users-view>
            </b-tab>
            <b-tab title="Account">
                <accounts-view :role="role"></accounts-view>
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

        //Not sure if I need to pass roles or permissions to anything. Seems like I could just stick with
        //auth()->user().

        props: {
            role: ''
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
