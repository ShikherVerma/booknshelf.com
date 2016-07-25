<!-- Please Login Modal -->
<app-please-login-modal :user="user" :book="book" v-show="show" inline-template>
    <div class="modal modal-mask" @click="close" v-show="show" transition="modal">
        <div class="modal-wrapper">
            <div class="modal-container" @click.stop>
                <div class="modal-header">
                    <button @click="close()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <h5 name="header">
                        Add to Bookshelf
                    </h5>
                </div>
                <div class="p-a-0">
                    <div name="body">
                        <div class="panel-body please-login-message">
                            <h5>To save a book or create bookshelves, please sign in.</h5>
                        </div>
                        <div class="panel-body">
                            <a type="submit" href="/login" class="btn btn-primary-outline">
                                <i class="fa fa-btn"></i>LOGIN TO CONTINUE
                            </a>
                        </div>
                    </div>
                </div>
         </div>
       </div>
    </div>
</app-please-login-modal>