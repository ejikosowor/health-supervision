
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

window.dt = require('datatables.net');

window.dtBootstrap = require('datatables.net-bs');

window.moment = require('moment');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('start-supervision', require('./components/online-supervisions/StartSupervision.vue'));
Vue.component('online-supervisions', require('./components/online-supervisions/Supervisions.vue'));
Vue.component('facility-supervisions', require('./components/facilities/Supervisions.vue'));
Vue.component('supervisions', require('./components/Supervisions.vue'));
Vue.component('facilities', require('./components/facilities/Facilities.vue'));

const app = new Vue({
    el: '#app'
});