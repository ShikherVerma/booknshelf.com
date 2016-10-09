<app-update-social :user="user" inline-template>
    <div>
        <div class="panel panel-default" v-if="user && user.facebook_user_id">
            <div class="panel-heading">Social Profiles</div>

            <div class="panel-body">
                <form class="form-horizontal" role="form">
                    <!-- Update Button -->
                    <div class="form-group">

                        <div class="col-md-6">
                            <a class="btn btn-block btn-social btn-facebook" href="{{ url('/disconnect/facebook') }}">
                              <span class="fa fa-facebook"></span> Disconnect from Facebook
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</app-update-social>
