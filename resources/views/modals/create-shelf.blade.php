<!-- Create Shelf Modal -->
<app-create-shelf :user="user" style="display: none;" inline-template>
    <div class="modal modal-mask" @click="close" v-show="show" id="modal-create-shelf" transition="modal">
        <div class="modal-wrapper">
            <div class="modal-container" @click.stop>
                <div class="modal-header" v-show="!success">
                    <button @click="close()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <h4>
                        Create a new bookshelf
                    </h4>
                </div>
                <div v-show="success">
                    <p>You've successfully created a bookshelf</p>
                </div>
                <form v-show="!success" class="form-horizontal p-b-none m-b-none" v-on:submit.prevent role="form">
                        <div class="modal-body">

                            <div class="form-group" :class="{'has-error': form.errors.has('name')}">
                                <div class="col-md-12">
                                    <input id="name" name="name" type="text" class="form-control" v-model="form.name" placeholder="Name">
                                    <span class="help-block" v-show="form.errors.has('name')">
                                        @{{ form.errors.get('name') }}
                                    </span>
                                </div>
                            </div>

                            <div class="form-group" :class="{'has-error': form.errors.has('description')}">
                                <div class="col-md-12">
                                    <input id="description" type="text" class="form-control" v-model="form.description" placeholder="What is this bookshelf about?">

                                    <span class="help-block" v-show="form.errors.has('description')">
                                        @{{ form.errors.get('description') }}
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

                        </div>

                    </form>
             </div>

        </div>
    </div>
</app-create-shelf>
