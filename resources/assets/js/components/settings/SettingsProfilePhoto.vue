<template>
    <div class="container" v-if="user">
        <div class="row">
            <div class="col-md-8">
                <div class="panel panel-default">
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
        </div>
    </div>
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
            }
        },


        computed: {
            previewStyle() {
                return `background-image: url(${this.user.avatar})`;
            }
        },

        mounted() {
            console.log('Component ready.')
        }
    }
</script>

<style lang="sass">
    .profile-photo-preview {
        display: inline-block;
        background-position: center;
        background-size: cover;
        height: 150px;
        vertical-align: middle;
        width: 150px;
    }
</style>
