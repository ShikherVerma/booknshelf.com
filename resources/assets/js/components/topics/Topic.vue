<template>
    <div class="column is-half">
        <article class="media">
            <figure class="media-left">
                <p class="image is-128x128">
                    <img :src="topic.cover_photo">
                </p>
            </figure>
            <div class="media-content">
                <div class="content">
                    <h1 class="subtitle is-4">{{ topic.name }}</h1>
                </div>
                <nav class="level">
                    <div class="level-left">
                        <a class="level-item">
                            <a class="button is-medium">Follow</a>
                        </a>
                        <br>
                        <span class="level-item">
                            10.124 followers
                        </span>
                    </div>
                </nav>
            </div>
            <div class="media-right">
            </div>
        </article>
    </div>

</template>

<script>
    export default {
        props: ['user', 'topic'],

        data() {
            return {
                form: new AppForm({
                    id: '',
                }),
            }
        },

        methods: {

            showBookSaveModal() {
                // if user is authenticated then show the save modal, otherwise login modal
                if (App.userId) {
                    console.log("auth");
                } else {
                    Bus.$emit('showPleaseLoginModal');
                }
            },

            follow() {
                this.$http.get(`/books/${this.topic.id}/likes`)
                    .then(response => {
                        this.likesCount = response.data.length;
                    });
            },

        },

        computed: {
        }
    }



</script>
