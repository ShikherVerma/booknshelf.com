
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('topic-card', require('./components/TopicCard.vue'));
Vue.component('topic-card-modal', require('./components/TopicCardModal.vue'));

// Settings Components
Vue.component('settings-profile-photo', require('./components/settings/SettingsProfilePhoto.vue'));
Vue.component('settings-profile-info', require('./components/settings/SettingsProfileInfo.vue'));
Vue.component('settings-profile-social', require('./components/settings/SettingsProfileSocial.vue'));

// Profile
Vue.component('profile', require('./components/Profile.vue'));
Vue.component('profile-shelves', require('./components/profile/ProfileShelves.vue'));
Vue.component('profile-shelf', require('./components/profile/ProfileShelf.vue'));

// Search
Vue.component('search', require('./components/Search.vue'));

// Shelf
Vue.component('shelf', require('./components/Shelf.vue'));
Vue.component('shelf-books', require('./components/shelf/ShelfBooks.vue'));
Vue.component('shelf-book', require('./components/shelf/ShelfBook.vue'));

// Modals
Vue.component('new-shelf-modal', require('./components/modals/NewShelfModal.vue'));

// Navbar
Vue.component('user-navbar', require('./components/UserNavbar.vue'));


// make sure to call Vue.use(Vuex) if using a module system
// import Vuex from 'vuex/dist/vuex';
// Vue.use(Vuex)

// const store = new Vuex.Store({
//     state: {
//         user: null
//     },

//     mutations: {
//         updateUser (state) {
//             console.log("okey will update the state");
//             // mutate state
//             state.user = user;
//             console.log(state.user);
//         }
//     }
// })

// This is the event hub we'll use in every
// component to communicate between them.
const eventHub = new Vue();
Vue.prototype.$eventHub = eventHub;

const app = new Vue({
    el: '#app',

    // store,

    data: {
        user: App.state.user,
    },

    methods: {
        updateUser() {
            console.log("Listned to the event");
            this.$http.get('/user/current')
                .then(response => {
                    this.user = response.data;
            });
        },
    },

    created: function () {
      this.$eventHub.$on('updateUser', this.updateUser)
    },

    // It's good to clean up event listeners before
    // a component is destroyed.
    // beforeDestroy: function () {
    //   this.$eventHub.$off('updateUser', this.addTodo)
    // },

    computed: {
        app() {
            return window.App;
        }
    },
});
