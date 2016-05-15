require('./app-bootstrap');

// load the components
require('./components/bootstrap');

var app = new Vue({
    mixins: [require('./booknshelf')]
});
