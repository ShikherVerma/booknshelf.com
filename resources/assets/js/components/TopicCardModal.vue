<template>
    <!-- the id of the modal can be a vue prop -->
    <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-2">
                            <div class="modal-body">
                                <!-- Project Details Go Here -->
                                <h2>Project Name</h2>
                                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                <img class="img-responsive img-centered" src="/img/portfolio/roundicons-free.png" alt="">
                                <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                <p>
                                    <strong>Want these icons in this portfolio item sample?</strong>You can download 60 of them for free, courtesy of <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">RoundIcons.com</a>, or you can purchase the 1500 icon set <a href="https://getdpd.com/cart/hoplink/18076?referrer=bvbo4kax5k8ogc">here</a>.</p>
                                <ul class="list-inline">
                                    <li>Date: July 2014</li>
                                    <li>Client: Round Icons</li>
                                    <li>Category: Graphic Design</li>
                                </ul>
                                <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-times"></i> Close Project</button>
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

        props: ['id'],

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
    .portfolio-modal .modal-dialog {
      margin: 0;
      height: 100%;
      width: auto;
    }
    .portfolio-modal .modal-content {
      border-radius: 0;
      background-clip: border-box;
      -webkit-box-shadow: none;
      box-shadow: none;
      border: none;
      min-height: 100%;
      padding: 100px 0;
      text-align: center;
    }
    .portfolio-modal .modal-content h2 {
      margin-bottom: 15px;
      font-size: 3em;
    }
    .portfolio-modal .modal-content p {
      margin-bottom: 30px;
    }
    .portfolio-modal .modal-content p.item-intro {
      margin: 20px 0 30px;
      font-family: "Droid Serif", "Helvetica Neue", Helvetica, Arial, sans-serif;
      font-style: italic;
      font-size: 16px;
    }
    .portfolio-modal .modal-content ul.list-inline {
      margin-bottom: 30px;
      margin-top: 0;
    }
    .portfolio-modal .modal-content img {
      margin-bottom: 30px;
    }
    .portfolio-modal .close-modal {
      position: absolute;
      width: 75px;
      height: 75px;
      background-color: transparent;
      top: 25px;
      right: 25px;
      cursor: pointer;
    }
    .portfolio-modal .close-modal:hover {
      opacity: 0.3;
    }
    .portfolio-modal .close-modal .lr {
      height: 75px;
      width: 1px;
      margin-left: 35px;
      background-color: #222222;
      transform: rotate(45deg);
      -ms-transform: rotate(45deg);
      /* IE 9 */
      -webkit-transform: rotate(45deg);
      /* Safari and Chrome */
      z-index: 1051;
    }
    .portfolio-modal .close-modal .lr .rl {
      height: 75px;
      width: 1px;
      background-color: #222222;
      transform: rotate(90deg);
      -ms-transform: rotate(90deg);
      /* IE 9 */
      -webkit-transform: rotate(90deg);
      /* Safari and Chrome */
      z-index: 1052;
    }
    .portfolio-modal .modal-backdrop {
      opacity: 0;
      display: none;
    }
</style>
