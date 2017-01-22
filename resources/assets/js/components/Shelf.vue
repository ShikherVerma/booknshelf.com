<template>
    <section class="hero is-small is-info is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ shelf.name }}
                </h1>
                <h2 class="subtitle" v-if="shelf.description">
                    {{ shelf.description}}
                </h2>
                <h2>
                    <div class="level">
                        <div class="level-left">
                            <p class="level-item">
                                <figure class="image is-48x48">
                                    <img :src="user.avatar">
                                </figure>
                            </p>
                            <p>
                                <a :href="profileUrl">
                                    <strong> &nbsp; {{ user.name }}</strong>
                            </a>
                            </p>
                        </div>
                        <div class="level-right">
                            <div v-if="canEditOrDelete" class="level-item">
                                <a class="button is-info" @click="showEditShelfModal = true">
                                    <span class="icon">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </h2>
            </div>
        </div>
        <edit-shelf-modal
                v-if="showEditShelfModal"
                :shelf="shelf"
                :user="user"
                @close="showEditShelfModal = false"
        ></edit-shelf-modal>
    </section>

        <!-- Update Shelf Modal -->
        <!--<div id="modal-update-shelf" class="modal" tabindex="-1" role="dialog">-->
            <!--<div class="modal-dialog" v-if="updatingShelf">-->
                <!--<div class="modal-content">-->
                    <!--<div class="modal-header p-a">-->
                        <!--<button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>-->

                        <!--<h4 class="modal-title">-->
                            <!--Edit Bookshelf-->
                        <!--</h4>-->
                    <!--</div>-->

                    <!--<div class="modal-body">-->
                        <!--&lt;!&ndash; Update Shelf Form &ndash;&gt;-->
                        <!--<form class="form-horizontal" v-on:submit.prevent role="form">-->
                            <!--&lt;!&ndash; Shelf Name &ndash;&gt;-->
                            <!--<div class="form-group" :class="{'has-error': updateShelfForm.errors.has('name')}">-->
                                <!--<label class="col-md-4 control-label">Name</label>-->

                                <!--<div class="col-md-6">-->
                                    <!--<input type="text" class="form-control" name="name" v-model="updateShelfForm.name">-->

                                    <!--<span class="help-block" v-show="updateShelfForm.errors.has('name')">-->
                                        <!--{{ updateShelfForm.errors.get('name') }}-->
                                    <!--</span>-->
                                <!--</div>-->
                            <!--</div>-->

                            <!--&lt;!&ndash; Shelf Description &ndash;&gt;-->
                            <!--<div class="form-group" :class="{'has-error': updateShelfForm.errors.has('description')}">-->
                                <!--<label class="col-md-4 control-label">Description</label>-->

                                <!--<div class="col-md-6">-->
                                    <!--<textarea class="form-control" name="description" v-model="updateShelfForm.description">-->
                                    <!--</textarea>-->

                                    <!--<span class="help-block" v-show="updateShelfForm.errors.has('description')">-->
                                        <!--{{ updateShelfForm.errors.get('description') }}-->
                                    <!--</span>-->
                                <!--</div>-->
                            <!--</div>-->

                        <!--</form>-->
                    <!--</div>-->

                    <!--&lt;!&ndash; Modal Actions &ndash;&gt;-->
                    <!--<div class="modal-footer">-->
                        <!--<button type="button" class="btn btn-danger" @click.prevent="deleteShelf">-->
                            <!--Delete Bookshelf-->
                        <!--</button>-->
                        <!--<button type="button" class="btn btn-primary-outline" data-dismiss="modal">Close</button>-->

                        <!--<button type="button" class="btn btn-primary" @click.prevent="updateShelf" :disabled="updateShelfForm.busy">-->
                            <!--Save-->
                        <!--</button>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</div>-->
        <!--</div>-->

</template>

<script>
    export default {
        props: ['user', 'shelf'],

        data() {
            return {
                showEditShelfModal: false
            }
        },

        computed: {
            profileUrl: function () {
                return '/@' + this.user.username;
            },

            canEditOrDelete() {
                return App.userId === this.user.id;
            }
        },
    }
</script>

<style lang="css">
</style>
