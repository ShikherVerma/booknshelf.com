<template>
    <div>
        <div v-if="isFacebookConnected" class="container is-light">
            <div class="columns">
                <div class="column is-4">
                    <p class="control">
                        <a class="button is-large fb-button" :href="facebook_disconnect_url">
                            <span class="icon">
                              <i class="fa fa-facebook"></i>
                            </span>
                            <span>Disconnect from Facebook</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <div v-if="!isFacebookConnected" class="container is-light">
            <div class="columns">
                <div class="column is-4">
                    <p class="control">
                        <a class="button is-large is-info fb-button" :href="facebook_connect_url">
                            <span class="icon">
                                <i class="fa fa-facebook"></i>
                            </span>
                            <span>Connect to Facebook</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'facebook_disconnect_url', 'facebook_connect_url'],

        computed: {
            isFacebookConnected() {
                return this.user.facebook_user_id !== null;
            }
        }
    }
</script>
