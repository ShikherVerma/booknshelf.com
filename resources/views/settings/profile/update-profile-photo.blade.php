<app-update-profile-photo :user="user" inline-template>
    <div>
        <div class="panel panel-default" v-if="user">
            <div class="panel-heading">Profile Photo</div>

            <div class="panel-body">
                <div class="alert alert-danger" style="display: none;" v-if="form.errors.has('photo')">
                    @{{ form.errors.get('photo') }}
                </div>

                <form class="form-horizontal" role="form">
                    <!-- Photo Preview-->
                    <div class="form-group">
                        <label class="col-md-4 control-label">&nbsp;</label>

                        <div class="col-md-6">
                            <span role="img" class="profile-photo-preview"
                                :style="previewStyle">
                            </span>
                        </div>
                    </div>

                    <!-- Update Button -->
                    <div class="form-group">
                        <label class="col-md-4 control-label">&nbsp;</label>

                        <div class="col-md-6">
                            <label type="button" class="btn btn-primary btn-upload" :disabled="form.busy">
                                <span>Select New Photo</span>

                                <input ref="photo" type="file" class="form-control" name="photo" @change="update">
                            </label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</app-update-profile-photo>
