<template>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <book v-for="book in books" :is-search="true ":book="book" :user="user" :likes="likes" :saves="saves"></book>
            </div>
        </div>
    </section>
</template>

<script>
    export default {

        props: ['books', 'user', 'likes', 'saves'],

        data() {
            return {
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

        }
    }

</script>

<style lang="sass">
</style>
