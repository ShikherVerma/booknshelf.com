require('./app-bootstrap');

// load the components
require('./components/bootstrap');

import Vuex from 'vuex/dist/vuex';
Vue.use(Vuex);

// This is the event hub we'll use in every
// component to communicate between them.
var eventHub = new Vue();

var app = new Vue({
    mixins: [require('./booknshelf')],
});

