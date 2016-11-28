<template>
    <div class="blogs-2" id="blogs-2">

        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1 text-center">
                    <h3 v-if="shelf.description">{{ shelf.description}}</h3>
                    <p>
                        by {{ user.name }}
                        <!--<div class="profile-photo-small">-->
                        <!--<a href="" class="profile-photo">-->
                        <!--<img :src="user.avatar" alt="avatar" class="img-circle img-responsive">-->
                        <!--by {{ user.name }}-->
                        <!--</a>-->
                        <!--</div>-->
                    </p>

                    <div class="row">
                        <shelf-book :user="user" v-for="book in books" :book="book"></shelf-book>
                    </div>

                </div>

            </div>



        </div>
    </div>

</template>

<script>
    export default {
        props: ['user', 'shelf', 'books'],

        mounted() {
            console.log(this.books);
            console.log('Component ready.')
        }
    }
</script>

<style lang="sass">
</style>
