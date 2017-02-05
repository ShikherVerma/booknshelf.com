<template>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <!--<profile-shelf v-for="shelf in shelves" :shelf="shelf" :user="user"></profile-shelf>-->
                <!--<search-book v-for="book in books" :book="book" :user="user"></search-book>-->
                <book v-for="book in books" :book="book" :user="user" :likes="likes" :saves="saves"></book>
            </div>
        </div>
    </section>
</template>

<script>
    export default {

        props: ['books', 'user', 'mostSavedBooks', 'likes', 'saves'],

        data() {
            return {
                saved: false,
                form: new AppForm({
                    id: '',
                    name: '',
                }),
            }
        },

        methods: {

            showSavePopover() {
                // display a loading state here
                this.getUserBookshelves();
                this.loading = false;
            },

            showBookSaveModal(book) {
                // if user is authenticated then show the save modal, otherwise login modal
                if (App.userId) {
                    Bus.$emit('showBookSaveModal', book);
                } else {
                    Bus.$emit('showPleaseLoginModal');
                }
            }

        },

        events: {
            bookSaved() {
                this.saved = true;
            }
        }
    }

</script>

<style lang="sass">
</style>
