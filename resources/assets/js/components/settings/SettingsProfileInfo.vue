<template>
    <div class="container is-light">
        <div class="columns">
            <div class="column is-4">
                <!-- Success Message -->
                <div class="notification is-success" v-show="form.successful">
                    <button class="delete"></button>
                    Your profile has been updated!
                </div>
                <form role="form">
                    <!--Name-->
                    <label class="label bigger-font-label">Name</label>
                    <p class="control">
                        <input class="input" name="name" type="text" v-model="form.name"
                               :class="{'is-danger': form.errors.has('name')}" placeholder="Your name ...">
                        <span class="help is-danger" v-if="form.errors.has('name')">
                            {{ form.errors.get('name') }}
                        </span>
                    </p>
                    <!--Email address-->
                    <label class="label bigger-font-label">E-mail address</label>
                    <p class="control">
                        <input class="input" name="name" type="email" v-model="form.email"
                               :class="{'is-danger': form.errors.has('email')}" placeholder="Your email address ...">
                        <span class="help is-danger" v-if="form.errors.has('email')">
                            {{ form.errors.get('email') }}
                        </span>
                    </p>
                    <!--Username-->
                    <label class="label bigger-font-label">Username</label>
                    <p class="control">
                        <input class="input" name="username" type="text" v-model="form.username"
                               :class="{'is-danger': form.errors.has('username')}" placeholder="Your username">
                        <span class="help is-danger" v-if="form.errors.has('username')">
                            {{ form.errors.get('username') }}
                        </span>
                    </p>
                    <!--About-->
                    <label class="label bigger-font-label">About</label>
                    <p class="control">
                        <textarea class="textarea" name="about" v-model="form.about"
                                  :class="{'is-danger': form.errors.has('username')}"
                                  placeholder="A little about you ...">
                        </textarea>
                        <span class="help is-danger" v-if="form.errors.has('about')">
                            {{ form.errors.get('about') }}
                        </span>
                    </p>

                    <div class="control">
                        <p class="control">
                            <button type="submit" class="button is-large is-primary is-outlined full-width-button"
                                    @click.prevent="update"
                                    :disabled="form.busy">
                                <strong>Update</strong>
                            </button>
                        </p>
                    </div>

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
                form: $.extend(true, new AppForm({
                    name: '',
                    email: '',
                    username: '',
                    about: ''
                }), [])
            };
        },

        mounted() {
            this.$nextTick(function () {
                this.form.name = this.user.name;
                this.form.email = this.user.email;
                this.form.username = this.user.username;
                this.form.about = this.user.about;
            })
        },

        methods: {
            update() {
                App.put('/settings/profile', this.form)
                    .then(() => {
                        this.$eventHub.$emit('updateUser');
                    });
            }
        },

    }

</script>
