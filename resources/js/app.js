/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('./bootstrap');

window.Vue = require('vue');
let vueResource = require('vue-resource');
Vue.use(vueResource);
Vue.http.options.emulateHTTP = true;
import VueRouter from 'vue-router'
Vue.use(VueRouter);


/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('item-component', require('./components/ItemComponent.vue').default);
Vue.component('list-component', require('./components/ListComponent.vue').default);
Vue.component('category-form-component', require('./components/CategoryFormComponent.vue').default);
Vue.component('product-component', require('./components/ProductComponent.vue').default);
Vue.component('product-item-component', require('./components/ProductItemComponent.vue').default);
Vue.component('new-product-component', require('./components/NewProductComponent.vue').default);

import HomeComponent from './components/HomeComponent';

const router = new VueRouter({
    mode: 'history',
    linkActiveClass: "is-active",
    routes: [
        {
            path: '/',
            component: HomeComponent,
            children: [
                {
                    path: ':id',
                    component: HomeComponent,
                    props: { router: true}
                },
            ]
        },
    ],
});
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
