<template>
    <div class="profile-header text-center">
        <div class="container">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <h2 class="profile-header-user shelf-header-user">{{ shelf.name }}</h2>
                <p v-if="shelf.description" class="profile-header-bio">
                    {{ shelf.description}}
                </p>
                <span>
                    <img class="img-circle small-profile-photo" :src="user.avatar">
                    <a class="profile-name" :href="profileUrl">
                        {{ user.name }}
                    </a>
                </span>
            </div>
            <div v-if="canEditOrDelete" class="col-md-2">
                <button class="btn btn-default" @click="showEditShelfModal()">
                    <i class="fa fa-pencil"></i> Edit
                </button>
            </div>
        </div>

        <nav class="profile-header-nav">
            <ul class="nav nav-tabs">
                <li>
                    <a href="#" class="books-count">{{ books.length }} Books</a>
                </li>
            </ul>
        </nav>

        <!-- Update Shelf Modal -->
        <div id="modal-update-shelf" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="updatingShelf">
                <div class="modal-content">
                    <div class="modal-header p-a">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Edit Bookshelf
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Update Shelf Form -->
                        <form class="form-horizontal" v-on:submit.prevent role="form">
                            <!-- Shelf Name -->
                            <div class="form-group" :class="{'has-error': updateShelfForm.errors.has('name')}">
                                <label class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" v-model="updateShelfForm.name">

                                    <span class="help-block" v-show="updateShelfForm.errors.has('name')">
                                        {{ updateShelfForm.errors.get('name') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Shelf Description -->
                            <div class="form-group" :class="{'has-error': updateShelfForm.errors.has('description')}">
                                <label class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="description" v-model="updateShelfForm.description">
                                    </textarea>

                                    <span class="help-block" v-show="updateShelfForm.errors.has('description')">
                                        {{ updateShelfForm.errors.get('description') }}
                                    </span>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" @click.prevent="deleteShelf">
                            Delete Bookshelf
                        </button>
                        <button type="button" class="btn btn-primary-outline" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click.prevent="updateShelf" :disabled="updateShelfForm.busy">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelf', 'books'],

        data() {
            return {
                updatingShelf: null,
                deletingShelf: null,
                updateShelfForm: new AppForm({
                    name: '',
                    description: '',
                }),
                deleteShelfForm: new AppForm({}),
            }
        },

        methods: {

            showEditShelfModal(shelf) {
                this.updatingShelf = this.shelf;
                this.initializeUpdateFormWith(this.shelf);
                $('#modal-update-shelf').modal('show');
            },

            /**
             * Initialize the edit form with the given shelf.
             */
            initializeUpdateFormWith(shelf) {
                this.updateShelfForm.name = shelf.name;
                this.updateShelfForm.description = shelf.description;
            },


            /**
             * Update the shelf being edited.
             */
            updateShelf() {
                App.put(`/shelves/${this.updatingShelf.id}`, this.updateShelfForm)
                    .then(() => {
                        this.shelf.name = this.updateShelfForm.name;
                        this.shelf.description = this.updateShelfForm.description;
                        $('#modal-update-shelf').modal('hide');
                    })
            },

            /**
             * Delete the specified shelf.
             */
            deleteShelf() {
                App.delete(`/shelves/${this.shelf.id}`, this.deleteShelfForm)
                    .then(() => {
                        // redirect back to the profile page
                        console.log("success");
                        window.location.replace(`/@${this.user.username}`);
                    });
            },

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
    .shelf-header-user {
        margin-top: 0px;
        color: #FFFFFF;
    }

    .profile-header-bio {
        color: #FFFFFF;
    }

    .profile-name, .profile-name:hover {
        font-size: 14px;
        color: #FFFFFF;
    }

    .small-profile-photo {
        height: 35px !important;
        width: 35px !important;
    }

    .books-count {
        color: #FFFFFF !important;
    }


</style>
