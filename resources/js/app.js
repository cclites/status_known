/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

window.Vue = require('vue');

Vue.use(BootstrapVue);
Vue.use(IconsPlugin);

//API
Vue.component('frame-loader', require('./components/FrameLoader.vue').default);

//Dev/Testing
Vue.component('draft-model-show', require('./components/utilities/draft-model-show.vue').default);

//Utilities
Vue.component('pagination', require('./components/utilities/Pagination.vue').default);
Vue.component('record-count', require('./components/utilities/RecordCount.vue').default);
Vue.component('menu-bar', require('./components/utilities/MenuBar.vue').default);

//Dashboards
Vue.component('dashboard-vue', require('./components/dashboard/DashboardView.vue').default);
Vue.component('admin-dashboard-vue', require('./components/dashboard/AdminDashboard.vue').default);
Vue.component('business-dashboard-vue', require('./components/dashboard/BusinessDashboard.vue').default);

//Tabs
//ToDo:: business-view shold be businesses-view
Vue.component('business-view', require('./components/views/BusinessView.vue').default);
Vue.component('invoices-view', require('./components/views/InvoicesView.vue').default);
Vue.component('users-view', require('./components/views/UsersView.vue').default);
Vue.component('accounts-view', require('./components/views/AccountsView.vue').default);
Vue.component('reports-view', require('./components/views/ReportsView.vue').default);
Vue.component('records-view', require('./components/views/RecordsView.vue').default);

//Show
Vue.component('business-show', require('./components/views/show/Business.vue').default);
Vue.component('account-show', require('./components/views/show/Account.vue').default);
Vue.component('invoice-show', require('./components/views/show/Invoice.vue').default);
Vue.component('payment-show', require('./components/views/show/Payment.vue').default);
Vue.component('provider-show', require('./components/views/show/Provider.vue').default);
Vue.component('report-show', require('./components/views/show/Report.vue').default);
Vue.component('record-show', require('./components/views/show/Record.vue').default);
Vue.component('user-show', require('./components/views/show/User.vue').default);

//Reports
Vue.component('businesses-report', require('./components/reports/Businesses.vue').default);
Vue.component('invoices-report', require('./components/reports/Invoices.vue').default);
Vue.component('users-report', require('./components/reports/Users.vue').default);

//------- CONTENT -------//
const app = new Vue({
    el: '#app',
}).$mount();
