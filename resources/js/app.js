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

Vue.component('dashboard-vue', require('./components/views/Dashboard.vue'));
Vue.component('admin-dashboard-vue', require('./components/views/AdminDashboard.vue'));
Vue.component('business-dashboard-vue', require('./components/views/BusinessDashboard.vue'));
Vue.component('checks-vue', require('./components/views/ChecksView.vue'));
Vue.component('business-vue', require('./components/views/BusinessView.vue'));
Vue.component('invoices-vue', require('./components/views/InvoicesView.vue'));
Vue.component('users-vue', require('./components/views/UsersView.vue'));

//Reports
Vue.component('checks-report', require('./components/reports/Checks.vue'));
Vue.component('businesses-report', require('./components/reports/Businesses.vue'));
Vue.component('invoices-report', require('./components/reports/Invoices.vue'));
Vue.component('users-report', require('./components/reports/Users.vue'));
//------- CONTENT -------//

const app = new Vue({
    el: '#request-input',
});
