Vue.component('app-create-shelf', {
    props: ['user'],

    data() {
        return {
            show: false,
            success: false,
            form: new AppForm({
                name: '',
                description: '',
                cover: '',
            })
        };
    },

    methods: {

        close() {
            this.show = false;
            this.success = false;
            this.form.errors.forget();
            this.form.name = '';
            this.form.description = '';
        },

        create() {
            App.post('/shelves', this.form)
                .then(() => {
                    $('#modal-create-shelf').modal('hide');

                    // reload the user shelves
                    this.$dispatch('reloadUserShelves');

                    this.form.name = '';
                    this.form.description = '';
                    this.form.errors.forget();

                    this.success = true;
                });
        },

        showCreateSuccessMessage() {
            swal({
                title: 'Got It!',
                text: 'Your bookshelf has successfully created.',
                showConfirmButton: false,
                timer: 2000
            });
        },

    },

    events: {
        showCreateNewShelfModal() {
            this.show = true;
        }
    },

    ready: function () {
        document.addEventListener("keydown", (e) => {
            if (this.show && e.keyCode == 27) {
                this.close();
            }
        });
    }

});
