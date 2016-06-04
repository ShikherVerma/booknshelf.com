<!-- Create Shelf Modal -->
<app-create-shelf :user="user" inline-template>
    <div class="modal" id="modal-create-shelf" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>

                    </button>
                    <h3 class="modal-title text-center">Create a new bookshelf</h3>
                </div>

                <form class="form-horizontal p-b-none m-b-none" role="form">
                    <div class="modal-body">

                        <div class="form-group form-group-lg" :class="{'has-error': form.errors.has('name')}">
                            <div class="col-md-8 col-md-offset-2">
                                <input id="name" type="text" class="form-control" v-model="form.name" placeholder="Name">
                                <span class="help-block" v-show="form.errors.has('name')">
                                    @{{ form.errors.get('name') }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group form-group-lg" :class="{'has-error': form.errors.has('description')}">
                            <div class="col-md-8 col-md-offset-2">
                                <input id="description" type="text" class="form-control" v-model="form.description" placeholder="Description">

                                <span class="help-block" v-show="form.errors.has('description')">
                                    @{{ form.errors.get('description') }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group form-group-lg">
                            <div class="col-md-6 col-md-offset-2">
                                <input type="text" class="form-control" placeholder="Search photos for your bookshelf cover...">
                            </div>
                            <div class="col-md-4">
                                <label type="button" class="btn btn-default-outline btn-upload" :disabled="form.busy">
                                    <i class="fa fa-plus"></i>
                                    <span>Upload an image</span>

                                    <input v-el:photo type="file" class="form-control" name="photo" @change="updateCoverPhoto">
                                </label>
                            </div>
                        </div>

                        <!-- Photo Preview-->
                        <div class="form-group form-group-lg">
                            <div class="col-md-6 col-md-offset-2">
                                <span role="img" class="shelf-cover-photo-preview" :style="previewStyle"></span>
                            </div>
                        </div>

                        <div class="form-group form-group-lg">
                            <div class="col-md-6 col-md-offset-2">
                                <button type="submit" class="btn-lg btn-info"
                                        @click.prevent="create"
                                        :disabled="form.busy">
                                    Create
                                </button>
                            </div>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</app-create-shelf>
