<template>
    <div class="modal is-active" @click="close" v-show="show">
        <div class="modal-background" @click="close"></div>
        <div class="modal-content">
            <section class="hero is-medium is-primary is-bold">
                <div class="hero-body">
                    <div class="container has-text-centered">
                        <h2 class="title is-3">
                            If you want to save or recommend a book you should create a profile first 😊.
                        </h2>
                        <h2 class="subtitle">
                            <a class="button is-primary is-large" href="/login">
                                Login to continue
                            </a>
                        </h2>
                    </div>
                </div>
            </section>
        </div>
        <button class="modal-close"></button>
    </div>
</template>

<script>
    export default {
        props: ['show'],

        methods: {

            close: function () {
                this.$eventHub.$emit('closePleaseLoginModal');
            },
        }
    }

</script>
<style lang="css">

</style>
