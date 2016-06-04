Vue.component('app-create-shelf', {
    props: ['user'],

    data() {
        return {
            form: new AppForm({
                name: '',
                description: '',
                access_type: '',
                cover_photo: '',
            })
        };
    },


    methods: {

        /**
         * Send a customer support request.
         */
        create() {
            App.post('/shelf/create', this.form)
                .then(() => {
                    $('#modal-create-shelf').modal('hide');

                    this.showCreateSuccessMessage();

                    this.form.name = '';
                    this.form.description = '';
                });
        },

        /**
         * Update the bookshelf's cover photo.
         */
        updateCoverPhoto(e) {
            e.preventDefault();

            this.form.startProcessing();

            const data = new FormData();
            console.log(this.$els.photo.files[0]);
            data.append('photo', this.$els.photo.files[0]);

            this.form.finishProcessing();
            this.cover_photo = data.photo;

            return data;
        },

        showCreateSuccessMessage() {
            swal({
                title: 'Got It!',
                text: 'Your bookshelf has successfully created.',
                type: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        }
    },

    computed: {
        previewStyle() {
            console.log(this.user.avatar);
            return `background-image: url(${this.user.avatar})`;
        }
    }
});
