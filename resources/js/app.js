
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import CxltToastr from 'cxlt-vue2-toastr'

import 'cxlt-vue2-toastr/dist/css/cxlt-vue2-toastr.css'

window.Vue = require('vue');

var toastrConfigs = {
    position: 'bottom left',
    showDuration: 1000
}
window.Vue.use(CxltToastr, toastrConfigs)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('user-info', require('./components/UserInfo.vue'));
Vue.component('answer', require('./components/Answer.vue'));
Vue.component('favorite', require('./components/Favorite.vue'));
Vue.component('accept', require('./components/Accept.vue'));

const app = new Vue({
    el: '#app'
});
