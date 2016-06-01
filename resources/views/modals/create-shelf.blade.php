<!-- Create Shelf Modal -->
<app-create-shelf inline-template>
    <div class="modal" id="modal-create-shelf" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>

                    </button>
                    <h4 class="modal-title text-center">Create a new bookshelf</h4>
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
                            <div class="col-md-8 col-md-offset-2">
                                <input type="text" class="form-control" placeholder="Search photos for your bookshelf cover. It will look amazing!">
                            </div>
                            <div class="col-md-2">
                                <a type="file"> Upload an image </a>
                            </div>
                        </div>

                        <div class="checkbox custom-control custom-checkbox col-md-offset-2"">
                            <label class="access-type">
                                <input type="checkbox">
                                <span class="custom-control-indicator"></span>
                                <input name="access_type" type="checkbox" v-bind:value="public" v-model="form.access_type"> Make this bookshelf private
                          </label>
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
