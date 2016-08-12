<app-profile-all-shelves :shelves="shelves" :user="user" inline-template>

    <div class="container max-width-1000 p-a">

        <!-- No Shelf -->
        <div class="row" v-if="shelves.length == 0">
            <div class="col-md-12">
                <div class="alert alert-warning hidden-xs" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h5 class="text-center">
                        Looks like you don't have any shelves yet. Create one!
                    </h5>
                </div>
            </div>
        </div>

        <!-- All Shelves -->
        <div class="row m-t" v-if="shelves.length > 0">
            <div class="col-md-3" v-for="shelf in shelves">
               <!--  Profile Shelf Item -->
                <app-profile-shelf-item :shelf="shelf" :user="user" inline-template>
                    <div class="panel shelf-card-item pos-r">
                        <div class="shelf-caption w-full pos-a">
                            <a v-bind:href="url">
                                @{{ shelf.name }}
                            </a>
                        </div>
                        <div v-if="canEditOrDelete()"  class="shelf-card-actions-bar w-full pos-a">
                            <button class="btn btn-sm btn-default-outline" @click="showEditShelfModal()">
                                <i class="fa fa-pencil"></i>
                            </button>
                            <button class="btn btn-sm btn-danger-outline" @click="showDeleteShelfModal()">
                                <i class="fa fa-times"></i>
                            </button>
                         </div>
                         <div>
                             <img class="media-object shelf-card-item-cover" :src="shelf.cover">
                         </div>
                    </div>
                </app-profile-shelf-item>
            </div>
        </div>

        <!-- Update Shelf Modal -->
        <div id="modal-update-shelf" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" v-if="updatingShelf">
                <div class="modal-content">
                    <div class="modal-header p-a">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Edit Bookshelf (@{{ updatingShelf.name }})
                        </h4>
                    </div>

                    <div class="modal-body">
                        <!-- Update Shelf Form -->
                        <form class="form-horizontal" v-on:submit.prevent role="form">
                            <!-- Shelf Name -->
                            <div class="form-group" :class="{'has-error': updateShelfForm.errors.has('name')}">
                                <label class="col-md-4 control-label">Shelf Name</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="name" v-model="updateShelfForm.name">

                                    <span class="help-block" v-show="updateShelfForm.errors.has('name')">
                                        @{{ updateShelfForm.errors.get('name') }}
                                    </span>
                                </div>
                            </div>

                            <!-- Shelf Description -->
                            <div class="form-group" :class="{'has-error': updateShelfForm.errors.has('description')}">
                                <label class="col-md-4 control-label">Shelf Description</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" name="description" v-model="updateShelfForm.description">
                                    </textarea>

                                    <span class="help-block" v-show="updateShelfForm.errors.has('description')">
                                        @{{ updateShelfForm.errors.get('description') }}
                                    </span>
                                </div>
                            </div>

                        </form>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

                        <button type="button" class="btn btn-primary" @click.prevent="updateShelf" :disabled="updateShelfForm.busy">
                            Update
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Shelf Modal -->
        <div  id="modal-delete-shelf"  class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-sm" v-if="deletingShelf">
                <div class="modal-content">
                    <div class="modal-header p-a">
                        <button type="button " class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                        <h4 class="modal-title">
                            Delete Bookshelf (@{{ deletingShelf.name }})
                        </h4>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete this bookshelf?
                    </div>
                    <!-- Modal Actions -->
                    <div class="modal-actions">
                        <button type="button" class="btn-default modal-action" data-dismiss="modal">No, Go Back</button>

                        <button type="button" class="btn-danger modal-action" @click.prevent="deleteShelf" :disabled="deleteShelfForm.busy">
                            Yes, Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</app-profile-all-shelves>
