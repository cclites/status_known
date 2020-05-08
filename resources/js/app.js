/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import BootstrapVue from 'bootstrap-vue'

window.Vue = require('vue');

Vue.use(BootstrapVue);

//Components
Vue.component('frame-loader', require('./components/FrameLoader.vue').default);

Vue.component('dashboard-vue', require('./components/views/DashboardView.vue').default);
Vue.component('admin-dashboard-vue', require('./components/views/AdminDashboard.vue').default);
Vue.component('business-dashboard-vue', require('./components/views/BusinessDashboard.vue').default);

Vue.component('checks-view', require('./components/views/ChecksView').default);
Vue.component('business-view', require('./components/views/BusinessView.vue').default);
Vue.component('invoices-view', require('./components/views/InvoicesView.vue').default);
Vue.component('users-view', require('./components/views/UsersView.vue').default);
Vue.component('accounts-view', require('./components/views/AccountsView.vue').default);
Vue.component('reports-view', require('./components/views/ReportsView.vue').default);

//Reports
Vue.component('checks-report', require('./components/reports/Checks.vue').default);
Vue.component('businesses-report', require('./components/reports/Businesses.vue').default);
Vue.component('invoices-report', require('./components/reports/Invoices.vue').default);
Vue.component('users-report', require('./components/reports/Users.vue').default);

//Components
Vue.component('pagination', require('./components/utilities/Pagination.vue').default);
Vue.component('record-count', require('./components/utilities/RecordCount.vue').default);




//------- CONTENT -------//


const app = new Vue({
    el: '#app',
}).$mount();
