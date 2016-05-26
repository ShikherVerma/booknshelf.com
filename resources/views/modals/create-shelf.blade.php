<!-- Create Shelf Modal -->
<app-create-shelf inline-template>
    <div class="modal" id="modal-create-shelf" tabindex="-1" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header text-center">
                    Create a new book shelf
                </div>

                <div class="modal-body p-b-none">
                    <form class="form-horizontal p-b-none m-b-none" role="form">

                        <div class="form-group" :class="{'has-error': form.errors.has('name')}">
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" v-model="form.name" placeholder="Name">

                                <span class="help-block" v-show="form.errors.has('name')">
                                    @{{ form.errors.get('name') }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group" :class="{'has-error': form.errors.has('description')}">
                            <div class="col-md-8">
                                <input id="description" type="text" class="form-control" v-model="form.description" placeholder="description">

                                <span class="help-block" v-show="form.errors.has('description')">
                                    @{{ form.errors.get('description') }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Search Unsplash for an amazing cover photo for your bookshelf">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8">
                                <input type="checkbox"> Make this book shelf private
                            </div>
                        </div>

                        <div>
                          <h5>Select an image</h5>
                          <input type="file">
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-6">
                                <button type="submit" class="btn btn-primary"
                                        @click.prevent="create"
                                        :disabled="form.busy">
                                    Create
                                </button>
                            </div>
                        </div>

                    </form>
                </div>

                <!-- Modal Actions -->
                <div class="modal-footer border-none">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</app-create-shelf>
