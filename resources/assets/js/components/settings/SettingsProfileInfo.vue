<template>
    <div class="panel panel-default">
        <div class="panel-heading">Profile Information</div>

        <div class="panel-body">
            <!-- Success Message -->
            <div class="alert alert-success" style="display: none;" v-show="form.successful">
                Your profile has been updated!
            </div>

            <form class="form-horizontal" role="form">
                <!-- Name -->
                <div class="form-group"  :class="{'has-error': form.errors.has('name')}">
                    <label class="col-md-4 control-label">Name</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="name" v-model="form.name">

                        <span class="help-block" style="display: none;" v-show="form.errors.has('name')">
                            {{ form.errors.get('name') }}
                        </span>
                    </div>
                </div>

                <!-- E-Mail Address -->
                <div class="form-group" :class="{'has-error': form.errors.has('email')}">
                    <label class="col-md-4 control-label">E-Mail Address</label>

                    <div class="col-md-6">
                        <input type="email" class="form-control" name="email" v-model="form.email">

                        <span class="help-block" style="display: none;" v-show="form.errors.has('email')">
                            {{ form.errors.get('email') }}
                        </span>
                    </div>
                </div>

                <!-- Username  -->
                <div class="form-group" :class="{'has-error': form.errors.has('username')}">
                    <label class="col-md-4 control-label">Username</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="username" v-model="form.username">

                        <span class="help-block" style="display: none;" v-show="form.errors.has('username')">
                            {{ form.errors.get('username') }}
                        </span>
                    </div>
                </div>

                <!-- About -->
                <div class="form-group" :class="{'has-error': form.errors.has('about')}">
                    <label class="col-md-4 control-label">About</label>

                    <div class="col-md-6">
                        <textarea class="form-control" name="about" v-model="form.about">
                        </textarea>

                        <span class="help-block"  style="display: none;" v-show="form.errors.has('about')">
                            {{ form.errors.get('about') }}
                        </span>
                    </div>
                </div>

                <!-- Update Button -->
                <div class="form-group">
                    <div class="col-md-offset-4 col-md-6">
                        <button type="submit" class="btn btn-primary"
                                @click.prevent="update"
                                :disabled="form.busy">
                            Update
                        </button>
                    </div>
                </div>
            </form>
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
