<template>
    <section class="hero is-small is-primary is-bold">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    {{ shelf.name }}
                </h1>
                <h2 class="subtitle" v-if="shelf.description">
                    {{ shelf.description}}
                </h2>
                <h2>
                    <div class="level">
                        <div class="level-left">
                            <p class="level-item">
                                <figure class="image is-48x48">
                                    <img :src="user.avatar">
                                </figure>
                            </p>
                            <p>
                                <a :href="profileUrl">
                                    <strong> &nbsp; {{ user.name }}</strong>
                            </a>
                            </p>
                        </div>
                        <div class="level-right">
                            <div v-if="canEditOrDelete" class="level-item">
                                <a class="button is-primary is-inverted is-outlined" @click="showEditShelfModal = true">
                                    <span class="icon">
                                        <i class="fa fa-pencil"></i>
                                    </span>
                                    <span>Edit</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </h2>
            </div>
        </div>
        <edit-shelf-modal
                v-if="showEditShelfModal"
                :shelf="shelf"
                :user="user"
                @close="showEditShelfModal = false"
        ></edit-shelf-modal>
    </section>
</template>

<script>
    export default {
        props: ['user', 'shelf'],

        data() {
            return {
                showEditShelfModal: false
            }
        },

        computed: {
            profileUrl: function () {
                return '/@' + this.user.username;
            },

            canEditOrDelete() {
                return App.userId === this.user.id;
            }
        },
    }
</script>

<style lang="css">
</style>
