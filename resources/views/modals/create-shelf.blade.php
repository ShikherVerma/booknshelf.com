<!-- Create Shelf Modal -->
<app-create-shelf inline-template>
    <div class="modal" id="modal-create-shelf" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title text-center">Create a new bookshelf</h4>
                </div>

                <form class="form-horizontal p-b-none m-b-none" role="form">
                    <div class="modal-body">
                        <div class="form-group form-group-lg" :class="{'has-error': form.errors.has('name')}">
                            <div class="col-md-8">
                                <input id="name" type="text" class="form-control" v-model="form.name" placeholder="Name">

                                <span class="help-block" v-show="form.errors.has('name')">
                                    @{{ form.errors.get('name') }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group form-group-lg" :class="{'has-error': form.errors.has('description')}">
                            <div class="col-md-8">
                                <input id="description" type="text" class="form-control" v-model="form.description" placeholder="description">

                                <span class="help-block" v-show="form.errors.has('description')">
                                    @{{ form.errors.get('description') }}
                                </span>
                            </div>
                        </div>

                        <div class="form-group form-group-lg">
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Search Unsplash for an amazing cover photo for your bookshelf">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="checkbox custom-control custom-checkbox">
                                <label>
                                    <input type="checkbox"> Make this book shelf private
                                    <span class="custom-control-indicator"></span>
                                </label>
                            </div>
                        </div>

                        <div>
                            <i class="icon fa fa-plus"></i>Upload an image
                            <h5>Select an image</h5>
                            <input type="file">
                        </div>
                    </div>

                    <!-- Modal Actions -->
                    <div class="modal-actions">
                      <button type="button" class="btn-link modal-action btn-lg" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn-link modal-action btn-lg"
                              @click.prevent="create"
                              :disabled="form.busy">
                          Create
                      </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</app-create-shelf>

<div class="modal">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Small modal</h4>
      </div>
      <div class="modal-body">
        <p>Modal body text...</p>
      </div>
      <div class="modal-actions">
        <button type="button" class="btn-link modal-action" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn-link modal-action" data-dismiss="modal">
          <strong>Continue</strong>
        </button>
      </div>
    </div>
  </div>
</div>