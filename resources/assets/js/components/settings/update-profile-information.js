Vue.component('app-update-profile-information', {

    props: ['user'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: $.extend(true, new AppForm({
                name: '',
                email: '',
                username: '',
                about: ''
            }), App.forms.updateProfileInformation)
        };
    },


    /**
     * Bootstrap the component.
     */
    ready() {
        this.form.name = this.user.name;
        this.form.email = this.user.email;
        this.form.username = this.user.username;
        this.form.about = this.user.about;
    },


    methods: {
        /**
         * Update the user's contact information.
         */
        update() {
            App.put('/settings/profile', this.form)
                .then(() => {
                    this.$dispatch('updateUser');
                });
        }
    }

});
