<template>
    <div class="panel panel-default" v-if="isFacebookConnected">
        <div class="panel-heading">Social Profiles</div>

        <div class="panel-body">
            <form class="form-horizontal" role="form">
                <!-- Update Button -->
                <div class="form-group">

                    <div class="col-md-6">
                        <a class="btn btn-block btn-social btn-facebook" :href="facebook_disconnect_url">
                          <span class="fa fa-facebook"></span> Disconnect from Facebook
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'facebook_disconnect_url'],

        computed: {
            isFacebookConnected() {
                return this.user.facebook_user_id !== null;
            }
        }
    }
</script>
