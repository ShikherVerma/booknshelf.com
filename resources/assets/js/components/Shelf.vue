<template>
    <div class="profile-header shelf-page-header text-center">
        <div class="container">
            <div class="col-md-2">
                <!-- Sharingbutton Facebook -->
                <a class="resp-sharing-button__link" href="https://facebook.com/sharer/sharer.php?u=http%3A%2F%2Fsharingbuttons.io" target="_blank" aria-label="">
                  <div class="resp-sharing-button resp-sharing-button--facebook resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                    <svg version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                        <g>
                            <path d="M18.768,7.465H14.5V5.56c0-0.896,0.594-1.105,1.012-1.105s2.988,0,2.988,0V0.513L14.171,0.5C10.244,0.5,9.5,3.438,9.5,5.32 v2.145h-3v4h3c0,5.212,0,12,0,12h5c0,0,0-6.85,0-12h3.851L18.768,7.465z"/>
                        </g>
                    </svg>
                    </div>
                  </div>
                </a>

                <!-- Sharingbutton Twitter -->
                <a class="resp-sharing-button__link" href="https://twitter.com/intent/tweet/?text=Super%20fast%20and%20easy%20Social%20Media%20Sharing%20Buttons.%20No%20JavaScript.%20No%20tracking.&amp;url=http%3A%2F%2Fsharingbuttons.io" target="_blank" aria-label="">
                  <div class="resp-sharing-button resp-sharing-button--twitter resp-sharing-button--small"><div aria-hidden="true" class="resp-sharing-button__icon resp-sharing-button__icon--solid">
                    <svg version="1.1" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" enable-background="new 0 0 24 24" xml:space="preserve">
                        <g>
                            <path d="M23.444,4.834c-0.814,0.363-1.5,0.375-2.228,0.016c0.938-0.562,0.981-0.957,1.32-2.019c-0.878,0.521-1.851,0.9-2.886,1.104 C18.823,3.053,17.642,2.5,16.335,2.5c-2.51,0-4.544,2.036-4.544,4.544c0,0.356,0.04,0.703,0.117,1.036 C8.132,7.891,4.783,6.082,2.542,3.332C2.151,4.003,1.927,4.784,1.927,5.617c0,1.577,0.803,2.967,2.021,3.782 C3.203,9.375,2.503,9.171,1.891,8.831C1.89,8.85,1.89,8.868,1.89,8.888c0,2.202,1.566,4.038,3.646,4.456 c-0.666,0.181-1.368,0.209-2.053,0.079c0.579,1.804,2.257,3.118,4.245,3.155C5.783,18.102,3.372,18.737,1,18.459 C3.012,19.748,5.399,20.5,7.966,20.5c8.358,0,12.928-6.924,12.928-12.929c0-0.198-0.003-0.393-0.012-0.588 C21.769,6.343,22.835,5.746,23.444,4.834z"/>
                        </g>
                    </svg>
                    </div>
                  </div>
                </a>
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
                <li class="active">
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
        }
    }
</script>

<style lang="sass">
    .shelf-page-header {
        background-color: #F5F5F5
    }

    .shelf-header-user {
        margin-top: 0px;
        color: #072B54;
    }

    .profile-header-bio {
        color: lighten(#072B54, 5%);
    }

    .profile-name {
        font-size: 14px;
    }

    .small-profile-photo {
        height: 35px !important;
        width: 35px !important;
    }

    .books-count {
        color: black !important;
    }

    .resp-sharing-button__link,
    .resp-sharing-button__icon {
      display: inline-block
    }

    .resp-sharing-button__link {
      text-decoration: none;
      color: #fff;
      margin: 0.5em
    }

    .resp-sharing-button {
      border-radius: 5px;
      transition: 25ms ease-out;
      padding: 0.5em 0.75em;
      font-family: Helvetica Neue,Helvetica,Arial,sans-serif
    }

    .resp-sharing-button__icon svg {
      width: 1em;
      height: 1em
    }

    .resp-sharing-button span {
      padding-left: 0.4em
    }

    /* Non solid icons get a stroke */
    .resp-sharing-button__icon {
      stroke: #fff;
      fill: none
    }

    /* Solid icons get a fill */
    .resp-sharing-button__icon--solid,
    .resp-sharing-button__icon--solidcircle {
      fill: #fff;
      stroke: none
    }

    .resp-sharing-button--twitter {
      background-color: #55acee
    }

    .resp-sharing-button--twitter:hover {
      background-color: #2795e9
    }

    .resp-sharing-button--facebook {
      background-color: #3b5998
    }

    .resp-sharing-button--facebook:hover {
      background-color: #2d4373
    }

    .resp-sharing-button--facebook {
      background-color: #3b5998;
      border-color: #3b5998;
    }

    .resp-sharing-button--facebook:hover,
    .resp-sharing-button--facebook:active {
      background-color: #2d4373;
      border-color: #2d4373;
    }

    .resp-sharing-button--twitter {
      background-color: #55acee;
      border-color: #55acee;
    }

    .resp-sharing-button--twitter:hover,
    .resp-sharing-button--twitter:active {
      background-color: #2795e9;
      border-color: #2795e9;
    }

</style>
