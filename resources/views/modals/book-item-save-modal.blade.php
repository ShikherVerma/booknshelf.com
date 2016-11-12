<!-- Book Item Save Modal -->
<app-book-item-save-modal :user="user" :book="book" inline-template>
    <transition name="modal">
        <div class="modal modal-mask" @click="close" v-show="show">
            <div class="modal-wrapper">

                <div v-show="loading" class="modal-container">
                    <div class="modal-header">
                        <div class="modal-body">
                            <span class="loading-spin">
                                <i v-show="loading" class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div v-show="!loading" class="modal-container" @click.stop>
                    <div class="modal-header">
                        <button @click="close()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span class="icon icon-cross"></span>
                        </button>
                        <h4 name="header">
                            Add to Bookshelf
                        </h4>
                    </div>
                    <div class="modal-body p-a-0">
                        <div class="modal-body-scroller">
                            <div name="body" v-show="!success">
                                <ul class="list-group" v-show="!loading">
                                    <li>
                                        <a class="btn btn-success" @click="showNewShelfForm=!showNewShelfForm"
                                        class="list-group-item add-new-shelf-button">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                        </a>
                                    </li>
                                    <li>
                                        <span v-show="showNewShelfForm">
                                            <form v-on:submit.prevent="storeBookToNewBookshelf" class="form-horizontal p-b-none m-b-none" role="form">
                                                <div class="input-group">
                                                    <input v-model="form.name" type="text" class="form-control"
                                                        placeholder="What's the name of the new bookshelf?">
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-success" type="submit" :disabled="form.busy">Add</button>
                                                    </span>
                                                </div>
                                            </form>
                                        </span>
                                    </li>
                                </ul>
                                <span class="help-block error-block" v-show="form.errors.has('name')">
                                    @{{ form.errors.get('name') }}
                                </span>
                                <ul class="list-group" v-for="shelf in shelves">
                                    <li id="@{{ book.id }}" class="list-group-item shelf-list-item"
                                        @click="storeBookToShelf(shelf.id)">@{{ shelf.name }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="nice-work-popover" v-show="success">
                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                            Great! The book has been added to your bookshelf.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </transition>
</app-book-item-save-modal>