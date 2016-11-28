<template>
    <div class="modal fade" id="newShelfModal" tabindex="-1" role="dialog" aria-labelledby="newShelfModal" aria-hidden="true">
        <div class="modal-dialog">

            <form class="form-horizontal" v-on:submit.prevent role="form">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                            <i class="material-icons">clear</i>
                        </button>
                        <h4 class="modal-title text-center">Create a new bookshelf</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group label-floating" :class="{'has-error': form.errors.has('name')}">
                            <div class="col-md-6">
                                <input id="name" name="name" type="text" class="form-control" v-model="form.name">
                                <div v-if="form.errors.has('name')">
                                    <label v-if="form.errors.has('name')" class="control-label">{{ form.errors.get('name') }}</label>
                                    <span class="material-icons form-control-feedback">clear</span>
                                </div>
                                <div v-else>
                                    <label for="i5" class="control-label">How do you want to call your bookshelf?</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group label-floating" :class="{'has-error': form.errors.has('description')}">
                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" v-model="form.description">
                                <div v-if="form.errors.has('description')">
                                    <label v-if="form.errors.has('description')" class="control-label">{{ form.errors.get('description') }}</label>
                                    <span class="material-icons form-control-feedback">clear</span>
                                </div>
                                <div v-else>
                                    <label for="i5" class="control-label">Tell a little bit about this bookshelf...</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            @click.prevent="create"
                            class="btn btn-success">Create</button>
                        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
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

                        this.form.name = '';
                        this.form.description = '';
                        this.form.errors.forget();
                    });
            },

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

        mounted() {
            console.log('Component new-shelf modal is ready.')
        }
    }
</script>
