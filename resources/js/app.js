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

//Views
Vue.component('dashboard-vue', require('./components/views/Dashboard.vue'));
Vue.component('business-vue', require('./components/views/Business.vue'));
Vue.component('report-vue', require('./components/views/Report.vue'));

Vue.component('checks-report', require('./components/reports/Checks.vue'));
Vue.component('businesses-report', require('./components/reports/Businesses.vue'));
Vue.component('invoices-report', require('./components/reports/Invoices.vue'));
Vue.component('users-report', require('./components/reports/Users.vue'));

Vue.component('-vue', require('./components/views/.vue'));

Vue.component('-vue', require('./components/views/.vue'));

Vue.component('-vue', require('./components/views/.vue'));
//------- CONTENT -------//

const app = new Vue({
    el: '#request-input',
});
