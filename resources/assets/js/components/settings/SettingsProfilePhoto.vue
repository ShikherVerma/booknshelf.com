<template>
    <div v-if="user" class="container is-light">
        <div class="columns">
            <div class="column is-4">
                <form role="form">
                    <div class="notification is-danger" v-if="form.errors.has('photo')">
                        <button class="delete"></button>
                        {{ form.errors.get('photo') }}
                    </div>
                    <p class="title">Update your profile photo</p>
                    <p class="control">
                        <span role="img" class="image is-128x128"
                              :style="previewStyle">
                        </span>
                    </p>
                    <p class="control">
                        <input class="button" ref="photo" type="file" :disabled="form.busy" name="photo"
                               @change="update">
                    </p>
                </form>
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
                        Bus.$emit('updateUser');
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

<style class="css">
    .inputfile {
    	width: 0.1px;
    	height: 0.1px;
    	opacity: 0;
    	overflow: hidden;
    	position: absolute;
    	z-index: -1;
    }


</style>
