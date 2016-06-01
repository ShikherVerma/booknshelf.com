Vue.component('app-create-shelf', {
    props: [],

    data() {
        return {
            form: new AppForm({
                name: '',
                description: '',
                access_type: '',
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

        showCreateSuccessMessage() {
            swal({
                title: 'Got It!',
                text: 'Your bookshelf has successfully created.',
                type: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        }
    }
});
