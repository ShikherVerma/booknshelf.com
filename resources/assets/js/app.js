
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
Vue.component('profile-shelf', require('./components/profile/ProfileShelf.vue'));

// Search
Vue.component('search', require('./components/Search.vue'));

// Shelf
Vue.component('shelf', require('./components/Shelf.vue'));
Vue.component('shelf-book', require('./components/shelf/ShelfBook.vue'));

// Modals
Vue.component('new-shelf-modal', require('./components/modals/NewShelfModal.vue'));

const app = new Vue({
    el: '#app',

    /**
     * The application's data.
     */
    data: {
        user: App.state.user,
    }
});
