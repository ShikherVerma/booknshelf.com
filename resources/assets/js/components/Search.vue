<template>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <!--<profile-shelf v-for="shelf in shelves" :shelf="shelf" :user="user"></profile-shelf>-->
                <search-book v-for="book in books" :book="book" :user="user"></search-book>
            </div>
        </div>
    </section>
</template>

<script>
    export default {

        props: ['books', 'user', 'mostSavedBooks'],

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
                    this.$eventHub.$emit('showBookSaveModal', book);
                } else {
                    this.$eventHub.$emit('showPleaseLoginModal');
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
