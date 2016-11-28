<template>
    <div class="main login-container">
        <div class="profile-content">
            <div class="container">
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <div class="profile">
                            <div class="avatar">
                                <img :src="user.avatar" alt="Circle Image" class="img-circle img-responsive img-raised">
                            </div>
                            <div class="name">
                                <h3 class="title">{{ user.name }}</h3>
                                <h6>{{ user.about }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active bookshelves" id="bookshelves">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="title">{{ shelves.length }} Bookshelves</h4>
                                <div class="row collections">
                                    <profile-shelf v-for="shelf in shelves" :shelf="shelf" :user="user">
                                    </profile-shelf>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelves'],

        mounted() {
            console.log('Component ready.')
        }
    }
</script>

<style lang="sass">
</style>
