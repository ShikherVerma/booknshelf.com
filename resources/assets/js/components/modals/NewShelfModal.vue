<template>
    <div class="modal fade" id="newShelfModal" tabindex="-1" role="dialog" aria-labelledby="newShelfModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button @click="close()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <h4 class="modal-title">Creat a new bookshelf</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">
                            <form class="form-horizontal" v-on:submit.prevent role="form">
                                <div class="form-group" :class="{'has-error': form.errors.has('name')}">
                                    <div class="col-md-12">
                                        <input id="name" name="name" type="text" class="form-control" v-model="form.name" placeholder="Name ...">
                                        <span class="help-block" v-show="form.errors.has('name')">
                                            {{ form.errors.get('name') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group" :class="{'has-error': form.errors.has('description')}">
                                    <div class="col-md-12">
                                        <input id="description" type="text" class="form-control" v-model="form.description" placeholder="Tell a little bit about this bookshelf ...">

                                        <span class="help-block" v-show="form.errors.has('description')">
                                            {{ form.errors.get('description') }}
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-primary"
                                                @click.prevent="create"
                                                :disabled="form.busy">
                                            Create
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
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

            close() {
                this.form.errors.forget();
                this.form.name = '';
                this.form.description = '';
            },

            create() {
                App.post('/shelves', this.form)
                    .then(() => {
                        $('#newShelfModal').modal('hide');
                        this.showCreateSuccessMessage();

                        this.form.name = '';
                        this.form.description = '';
                        this.form.errors.forget();
                    });
            },

            showCreateSuccessMessage() {
                swal({
                    title: 'Success!',
                    text: 'Your bookshelf has successfully created.',
                    type: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
            },

            // mounted: function () {
            //     this.$nextTick(function () {
            //         document.addEventListener("keydown", (e) => {
            //             if (this.show && e.keyCode == 27) {
            //                 this.close();
            //             }
            //         });
            //     })
            // }

        }
    }
</script>
