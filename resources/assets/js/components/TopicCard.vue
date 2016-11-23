<template>
    <div class="col-lg-3 col-md-4 col-xs-6 thumb hvr-grow">
        <a class="thumbnail" href="#">
            <img class="img-responsive" src="http://placehold.it/400x300" alt="">
        </a>
    </div>
    <!--<div class="col-md-4 topic-item hvr-grow">-->
        <!--<a href="#" class="topic-item-link">-->
            <!--<div class="panel panel-default m-b-md hidden-xs">-->
                <!--<div class="panel-body">-->
                    <!--<img class="media-object" src="https://source.unsplash.com/random">-->
                <!--</div>-->
            <!--</div>-->
        <!--</a>-->
    <!--</div>-->
</template>

<script>
    export default {

        props: ['test'],

        data() {
            return {
                message: 'tigran jan'
            }
        },

        mounted() {
            console.log('Component ready.')
        }
    }
</script>

<style>
    .thumb {
        margin-bottom: 30px;
    }
</style>
