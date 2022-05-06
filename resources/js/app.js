import Vue from 'vue'

import VueAxios from 'vue-axios'
window.axios = require('axios');
Vue.use(VueAxios, axios)

Vue.component('header-menu', require('./components/HeaderMenu.vue').default);

const app = new Vue({
    el: '#app'
});
require('bootstrap');


