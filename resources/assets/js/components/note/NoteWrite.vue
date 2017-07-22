<template>
    <article class="media note-media">
        <figure class="media-left">
            <p class="image is-48x48">
                <img :src="avatarUrl" class="book-info-modal-profile-pic">
            </p>
        </figure>
        <div class="media-content">
            <div class="field">
                <p class="control">
                    <textarea class="textarea" name="text" v-model="form.text"
                               :class="{'is-danger': form.errors.has('text')}"
                        style="min-height: 80px;" placeholder="Add your note here ...">
                    </textarea>
                    <span class="help is-danger" v-if="form.errors.has('text')">
                        {{ form.errors.get('text') }}
                    </span>
                </p>
            </div>
            <nav class="level" style="margin-top: 7px;">
                <div class="level-left">
                    <div class="level-item">
                        <button type="submit" class="button is-primary note-save-button"
                                @click.prevent="create"
                                :disabled="form.busy">
                            <strong>SAVE</strong>
                        </button>
                    </div>
                </div>
                <div class="level-right">
                    <div class="level-item">
                        <label class="checkbox">
                            <input type="checkbox" name="is_private" v-model="form.is_private"> Make this note private
                        </label>
                    </div>
                </div>
            </nav>
        </div>
    </article>
</template>

<script>
    export default {
        props: ['user', 'book'],

        data() {
            return {
                form: $.extend(true, new AppForm({
                    text: '',
                    is_private: false,
                    book_id: this.book.id
                }), [])
            }
        },

        methods: {
            create() {
                App.post('/api/notes', this.form)
                    .then(() => {
                        Bus.$emit('newNoteSaved');
                        this.form.text = '';
                        this.form.is_private = false;
                        // send a notification
                        Vue.toast('🎉 Your note has been added!', {
                            className: ['notification', 'is-success', 'save-note-notification'],
                            horizontalPosition: 'right',
                            verticalPosition: 'bottom',
                            duration: 5000,
                        });
                    }).catch(function(reason) {
                        console.log(reason);
                    });
            }
        },

        computed: {
            avatarUrl() {
                return "https://booknshelf.imgix.net/profiles/" + this.user.avatar + "?auto=format&auto=compress&codec=mozjpeg&cs=strip&w=48&h=48&fit=crop";
            },
        },
    }
</script>

<style type="text/css">
    .book-info-modal-profile-pic {
        border-radius: 50%;
    }
    .note-media {
        background-color: rgba(220, 220, 220, 0.24);
        padding: 12px;
        border-radius: 5px;
    }

    .note-save-button {
        background-color: #669890 !important;
        font-weight: bold;
    }

    .save-note-notification {
        margin-right: 50px;
        margin-bottom: 50px;
        font-weight: bold;
    }
</style>
