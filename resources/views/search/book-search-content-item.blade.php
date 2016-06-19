<app-book-search-content-item inline-template>
    <div class="flex-item">
        <div class="flex-book-container">
            <div class="flex-book-container-item">
                <img data-action="zoom" style="width: 150px;" src="{{ $book['image'] }}">
            </div>
            <div class="flex-book-container-item">
                <div class="flex-container">
                    <div class="book-title">
                        {{ $book['title'] }}
                    </div>
                    <div class="book-author">
                        {{ $book['authors'] or '' }}
                    </div>
                </div>
            </div>
            <!-- Actions -->
            <div class="flex-book-container-item">
                <a class="btn btn-default btn-sm" href="{{ $book['info_link'] }}" target="_blank">
                    <i class="fa fa-external-link" aria-hidden="true"></i>
                </a>
                <a class="btn btn-default btn-sm" href="#" @click="showSavePopover()">
                    <i class="fa fa-list"></i> Save
                </a>
                <div class="save-popover" v-if="show" transition="expand">
                    <i v-show="loading" class="fa fa-circle-o-notch fa-spin fa-2x fa-fw"></i>
                    <ul class="list-group" v-for="shelf in shelves">
                        <li v-el:book id="{{ $book['id'] }}" class="list-group-item"
                            @click="saveBookToBookshelf()">@{{ shelf.name }}</li>
                    </ul>
                    <span @click="showNewBookshelfForm=!showNewBookshelfForm">Add New</span>

                    <form class="form-horizontal p-b-none m-b-none" role="form">
                        <div v-show="showNewBookshelfForm" class="input-group">
                            <input v-model="form.name" placeholder="Name" type="text" class="form-control" placeholder="Name">
                            <span class="help-block" v-show="form.errors.has('name')">
                                @{{ form.errors.get('name') }}
                            </span>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default"
                                        @click.prevent="saveBookToNewBookshelf"
                                        :disabled="form.busy">
                                    Add
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="nice-work-popover" v-show="addSuccessPopover" transition="expand">
                    Greate! "This book" has been added to your bookshelf "this bookshelf".
                </div>
            </div>

        </div>
    </div>
</app-book-search-content-item>
