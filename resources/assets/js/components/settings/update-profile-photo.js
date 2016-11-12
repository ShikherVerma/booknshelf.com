Vue.component('app-update-profile-photo', {
    props: ['user'],

    /**
     * The component's data.
     */
    data() {
        return {
            form: new AppForm({})
        };
    },


    methods: {
        /**
         * Update the user's profile photo.
         */
        update(e) {
            e.preventDefault();

            this.form.startProcessing();

            // We need to gather a fresh FormData instance with the profile photo appended to
            // the data so we can POST it up to the server. This will allow us to do async
            // uploads of the profile photos. We will update the user after this action.
            this.$http.post('/settings/photo', this.gatherFormData())
                .then(function(response) {
                    this.$dispatch('updateUser');

                    this.form.finishProcessing();
                })
                .catch(function(response) {
                    this.form.setErrors(response.data);
                });
        },


        /**
         * Gather the form data for the photo upload.
         */
        gatherFormData() {
            const data = new FormData();
            data.append('photo', this.$refs.photo.files[0]);
            return data;
        }
    },


    computed: {
        previewStyle() {
            return `background-image: url(${this.user.avatar})`;
        }
    }
});
