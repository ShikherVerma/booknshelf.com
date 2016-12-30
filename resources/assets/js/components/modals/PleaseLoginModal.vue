<template>
    <transition name="modal">
        <div class="modal-mask" @click="close"  v-show="show">
             <div class="modal-wrapper">
                 <div class="modal-container" @click.stop>
                    <div class="modal-header please-login-modal-header">
                        <button @click="close()" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="p-a-0">
                         <div name="body">
                             <div class="panel-body please-login-message">
                                 <h5>To save a book or create bookshelves, please sign in.</h5>
                             </div>
                             <div class="panel-body">
                                 <a type="submit" href="/login" class="btn btn-primary-outline">
                                     <i class="fa fa-btn"></i>LOGIN TO CONTINUE
                                 </a>
                             </div>
                         </div>
                    </div>
              </div>
            </div>

        </div>
    </transition>
</template>

<script>
    export default {
        props: ['show'],

        methods: {

            close: function () {
                this.$eventHub.$emit('closePleaseLoginModal');
            },
        },

        mounted: function () {
            this.$nextTick(function () {
                document.addEventListener("keydown", (e) => {
                    if (this.show && e.keyCode == 27) {
                        this.close();
                    }
                });
            })
        }
    }
</script>
<style lang="css">
    .modal-mask {
      position: fixed;
      z-index: 9998;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, .5);
      display: table;
      transition: opacity .3s ease;
    }

    .modal-wrapper {
      display: table-cell;
      vertical-align: middle;
    }

    .modal-container {
      width: 600px;
      margin: 0px auto;
      padding: 20px 30px;
      background-color: #fff;
      border-radius: 2px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
      transition: all .3s ease;
    }

    .please-login-modal-header {
        border-bottom: none !important;
    }

    .modal-header h3 {
      margin-top: 0;
      color: #42b983;
    }

    .modal-body {
      margin: 20px 0;
    }

    .modal-default-button {
      float: right;
    }

    /*
     * The following styles are auto-applied to elements with
     * transition="modal" when their visibility is toggled
     * by Vue.js.
     *
     * You can easily play with the modal transition by editing
     * these styles.
     */

    .modal-enter {
      opacity: 0;
    }

    .modal-leave-active {
      opacity: 0;
    }

    .modal-enter .modal-container,
    .modal-leave-active .modal-container {
      -webkit-transform: scale(1.1);
      transform: scale(1.1);
    }

</style>
