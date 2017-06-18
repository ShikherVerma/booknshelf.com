<template>
    <div class="column is-one-third">
        <p class="notification is-info">
            <code class="html">is-one-third</code>
        </p>
    </div>
</template>

<script>
    export default {
        props: ['book', 'user'],

        data() {
            return {
                form: new AppForm({
                    id: '',
                }),
            }
        },

        methods: {
        },

        computed: {
        },

        /**
        * Bootstrap the component.
        */
        mounted() {
            this.form.id = this.book.id;
        },
    }
</script>

<style lang="css">

</style>
