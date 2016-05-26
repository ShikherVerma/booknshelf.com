Vue.component('app-create-shelf', {
    props: [],

    data() {
        return {
            form: new AppForm({
                name: '',
                description: ''
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
                text: 'We have received your message and will respond soon!',
                type: 'success',
                showConfirmButton: false,
                timer: 2000
            });
        }
    }
});
