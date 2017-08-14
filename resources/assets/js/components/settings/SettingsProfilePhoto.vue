<template>
    <div v-if="user" class="container is-light">
        <div class="columns">
            <div class="column">
                <form role="form">
                    <div class="notification is-danger" v-if="form.errors.has('photo')">
                        {{ form.errors.get('photo') }}
                    </div>
                    <p class="control">
                        <span role="img" class="image is-128x128"
                              :style="previewStyle">
                        </span>
                    </p>
                    <p class="control">
                        <input @change="update" ref="photo" type="file" name="photo" id="file-1"
                            class="inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple />
                        <label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Select file</span></label>
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
                console.log(this.user.avatar);
                var avatarUrl = "https://booknshelf.imgix.net/profiles/" + this.user.avatar + "?auto=format&fit=crop&h=128&w=128";
                return `background-image: url(${avatarUrl});background-position: center center; background-size: cover;`;
            }
        }
    }



</script>

<style type="text/css">
    .inputfile {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .inputfile + label {
        max-width: 80%;
        font-size: 1.25rem;
        /* 20px */
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        display: inline-block;
        overflow: hidden;
        padding: 0.625rem 1.25rem;
        /* 10px 20px */
    }

    .no-js .inputfile + label {
        display: none;
    }

    .inputfile:focus + label,
    .inputfile.has-focus + label {
        outline: 1px dotted #000;
        outline: -webkit-focus-ring-color auto 5px;
    }

    .inputfile + label * {
        /* pointer-events: none; */
        /* in case of FastClick lib use */
    }

    .inputfile + label svg {
        width: 1em;
        height: 1em;
        vertical-align: middle;
        fill: currentColor;
        margin-top: -0.25em;
        /* 4px */
        margin-right: 0.25em;
        /* 4px */
    }


    /* style 1 */

    .inputfile-1 + label {
        color: #f1e5e6;
        background-color: #E95352;
    }

    .inputfile-1:focus + label,
    .inputfile-1.has-focus + label,
    .inputfile-1 + label:hover {
        background-color: #722040;
    }

</style>
