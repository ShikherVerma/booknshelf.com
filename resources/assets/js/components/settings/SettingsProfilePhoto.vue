<template>
    <div v-if="user" class="container is-light">
        <div class="columns">
            <div class="column is-4">
                <form role="form">
                    <div class="notification is-danger" v-if="form.errors.has('photo')">
                        <button class="delete"></button>
                        {{ form.errors.get('photo') }}
                    </div>

                    <p class="control">
                        <span role="img" class="image is-128x128"
                            :style="previewStyle">
                        </span>
                        <input class="button is-primary" ref="photo" type="file" :disabled="form.busy" name="photo" @change="update">
                    </p>
                    <p class="control">
                        <a class="button is-primary">
                          <span class="icon">
                            <i class="fa fa-twitter"></i>
                          </span>
                          <span>Twitter</span>
                        </a>
                    </p>
                </form>
            </div>
        </div>
    </div>
    <!--<div class="panel panel-default" v-if="user">-->
        <!--<div class="panel-heading">Profile Photo</div>-->

        <!--<div class="panel-body">-->
            <!--<form class="form-horizontal" role="form">-->
                <!--<div class="alert alert-danger" style="display: none;" v-if="form.errors.has('photo')">-->
                    <!--{{ form.errors.get('photo') }}-->
                <!--</div>-->
                <!--&lt;!&ndash; Photo Preview&ndash;&gt;-->
                <!--<div class="form-group">-->
                    <!--<label class="col-md-4 control-label">&nbsp;</label>-->

                    <!--<div class="col-md-6">-->
                        <!--<span role="img" class="profile-photo-preview"-->
                            <!--:style="previewStyle">-->
                        <!--</span>-->
                    <!--</div>-->
                <!--</div>-->

                <!--&lt;!&ndash; Update Button &ndash;&gt;-->
                <!--<div class="form-group">-->
                    <!--<label class="col-md-4 control-label">&nbsp;</label>-->

                    <!--<div class="col-md-6">-->
                        <!--<label type="button" class="btn btn-primary btn-upload" :disabled="form.busy">-->
                            <!--<span>Select New Photo</span>-->

                            <!--<input ref="photo" type="file" class="form-control" name="photo" @change="update">-->
                        <!--</label>-->
                    <!--</div>-->
                <!--</div>-->
            <!--</form>-->
        <!--</div>-->
    <!--</div>-->
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                form: new AppForm({})
            };
        },

        methods: {
            /**
             * Update the user's profile photo.
             */
            update(e) {
                e.preventDefault();
                this.form.startProcessing();
                // We need to gather a fresh FormData instance with the profile photo appended to
                // the data so we can POST it up to the server. This will allow us to do async
                // uploads of the profile photos. We will update the user after this action.
                this.$http.post('/settings/photo', this.gatherFormData())
                    .then(function(response) {
                        // this.$dispatch('updateUser');
                        this.$eventHub.$emit('updateUser');
                        this.form.finishProcessing();
                    })
                    .catch(function(response) {
                        this.form.setErrors(response.data);
                    });
            },

            /**
             * Gather the form data for the photo upload.
             */
            gatherFormData() {
                const data = new FormData();
                data.append('photo', this.$refs.photo.files[0]);
                return data;
            },
        },

        computed: {
            previewStyle() {
                return `background-image: url(${this.user.avatar});background-position: center center; background-size: cover;`;
            }
        }
    }
</script>
