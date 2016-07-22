Vue.component('app-create-shelf', {
    props: ['user'],

    data() {
        return {
            form: new AppForm({
                name: '',
                description: '',
                cover: '',
            })
        };
    },

    methods: {

        create() {
            App.post('/shelves', this.form)
                .then(() => {
                    $('#modal-create-shelf').modal('hide');

                    this.showCreateSuccessMessage();

                    // reload the user shelves
                    this.$dispatch('reloadUserShelves');

                    this.form.name = '';
                    this.form.description = '';
                });
        },

        showCreateSuccessMessage() {
            swal({
                title: 'Got It!',
                text: 'Your bookshelf has successfully created.',
                showConfirmButton: false,
                timer: 2000
            });
        }
    },

});
