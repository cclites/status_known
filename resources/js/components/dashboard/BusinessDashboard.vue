<template>
    <div class="rows">
        <b-tabs>
            <b-tab title="Invoices">
                <invoices-view :role="role"></invoices-view>
            </b-tab>
            <b-tab title="Users">
                <users-view :role="role"></users-view>
            </b-tab>
            <b-tab title="Records">
                <records-view :role="role"></records-view>
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
