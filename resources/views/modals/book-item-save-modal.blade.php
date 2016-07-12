<!-- Book Item Save Modal -->
<app-book-item-save-modal :user="user" :book="book" v-show="show" inline-template>
    <div class="modal modal-mask" @click="close" v-show="show" transition="modal">
        <div class="modal-wrapper">
            <div class="modal-container" @click.stop>
                <div class="modal-header">
                    <button @click="close()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <slot name="header">
                        Add to Bookshelf
                    </slot>
                </div>
                <div class="modal-body p-a-0">
                    <div class="modal-body-scroller">
                        <div name="body" v-show="!success">
                            <span class="loading-spin">
                                <i v-show="loading" class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
                            </span>
                            <ul class="list-group" v-for="shelf in shelves">
                                <li id="@{{ book.id }}" class="list-group-item shelf-list-item"
                                    @click="storeBookToShelf(shelf.id)">@{{ shelf.name }}
                                </li>
                            </ul>
                            <ul class="list-group" v-show="!loading">
                                <li @click="showNewShelfForm=!showNewShelfForm"
                                    class="list-group-item add-new-shelf-button">
                                    <i class="fa fa-plus" aria-hidden="true"></i> Add New
                                </li>
                            </ul>
                            <span v-show="showNewShelfForm">
                                <form v-on:submit.prevent="storeBookToNewBookshelf" class="form-horizontal p-b-none m-b-none" role="form">
                                    <div class="input-group">
                                        <input v-model="form.name" type="text" class="form-control"
                                            placeholder="The name of the new bookshelf">
                                        <span class="help-block" v-show="form.errors.has('name')">
                                            @{{ form.errors.get('name') }}
                                        </span>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit" :disabled="form.busy">Add</button>
                                        </span>
                                    </div>
                                </form>
                            </span>
                        </div>
                    </div>
                    <div class="nice-work-popover" v-show="success">
                        <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                        Great! The book has been added to your bookshelf.
                    </div>
                </div>

           <div class="modal-footer">
           </div>
         </div>
       </div>
    </div>
</app-book-item-save-modal>