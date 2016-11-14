<template>
    <div class="col-md-4 col-sm-6 portfolio-item">
    <a href="#portfolioModal1" class="portfolio-link" data-toggle="modal">
        <div class="portfolio-hover">
            <div class="portfolio-hover-content">
                <i class="fa fa-plus fa-3x"></i>
            </div>
        </div>
        <img src="/img/portfolio/roundicons.png" class="img-responsive" alt="">
    </a>
    <div class="portfolio-caption">
        <h4>Round Icons</h4>
        <p class="text-muted">Graphic Design</p>
    </div>
    </div>
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

<style lang="sass">
    #portfolio .portfolio-item {
        margin: 0 0 15px;
        right: 0;
    }
    #portfolio .portfolio-item .portfolio-link {
        display: block;
        position: relative;
        max-width: 400px;
        margin: 0 auto;
    }
    #portfolio .portfolio-item .portfolio-link .portfolio-hover {
        background: rgba(254, 209, 54, 0.9);
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: all ease 0.5s;
        -webkit-transition: all ease 0.5s;
        -moz-transition: all ease 0.5s;
    }
    #portfolio .portfolio-item .portfolio-link .portfolio-hover:hover {
        opacity: 1;
    }
    #portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content {
        position: absolute;
        width: 100%;
        height: 20px;
        font-size: 20px;
        text-align: center;
        top: 50%;
        margin-top: -12px;
        color: white;
    }
    #portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content i {
        margin-top: -12px;
    }
    #portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content h3,
    #portfolio .portfolio-item .portfolio-link .portfolio-hover .portfolio-hover-content h4 {
        margin: 0;
    }
    #portfolio .portfolio-item .portfolio-caption {
        max-width: 400px;
        margin: 0 auto;
        background-color: white;
        text-align: center;
        padding: 25px;
    }
    #portfolio .portfolio-item .portfolio-caption h4 {
        text-transform: none;
        margin: 0;
    }
    #portfolio .portfolio-item .portfolio-caption p {
        font-family: "Droid Serif", "Helvetica Neue", Helvetica, Arial, sans-serif;
        font-style: italic;
        font-size: 16px;
        margin: 0;
    }
    #portfolio * {
        z-index: 2;
    }
    @media (min-width: 767px) {
        #portfolio .portfolio-item {
            margin: 0 0 30px;
      }
    }
</style>
