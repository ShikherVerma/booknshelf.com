/*
 * Load Vue & Vue-Resource.
 *
 */
if (window.Vue === undefined) {
    window.Vue = require('vue/dist/vue.js');
}

require('vue-resource');


/**
 * Load Vue HTTP Interceptors.
 */
Vue.http.interceptors.push(() => {
    return require('./interceptors');
});

/**
 * Load Vue Global Mixin.
 */
Vue.mixin(require('./mixin'));

/**
 * Define the Vue filters.
 */
require('./filters');

/**
 * Load the Spark form utilities.
 */
require('./forms/bootstrap');
