/*
* First we will load all of this project's JavaScript dependencies which
* includes Vue and other libraries. It is a great starting point when
* building robust, powerful web applications using Vue and Laravel.
*/

require('./bootstrap');

import Vue from 'vue'

Vue.component('products', require('./components/Products.vue').default);

if (document.getElementById("productContent")) {
    window.productContent = new Vue({
        el: '#productContent',
    });
}
