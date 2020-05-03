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

Vue.component('Testclass3-vue', require('./components/Testclass3.vue'));
//------- CONTENT -------//

const app = new Vue({
    el: '#request-input',
});
