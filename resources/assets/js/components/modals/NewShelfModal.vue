<template>
    <div class="modal is-active">
      <div class="modal-background" @click="$emit('close')"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Creat a new bookshelf</p>
          <button class="delete" @click="$emit('close')"></button>
        </header>
        <section class="modal-card-body">
            <div class="content">
                <form v-on:submit.prevent>
                    <label class="label">Name</label>
                    <p class="control">
                        <input class="input" name="name" type="text" v-model="form.name"
                               :class="{'is-danger': form.errors.has('name')}">
                        <span class="help is-danger" v-show="form.errors.has('name')">
                            {{ form.errors.get('name') }}
                        </span>
                    </p>
                    <label class="label">Description</label>
                    <p class="control">
                        <input class="input" name="name" type="text" v-model="form.description"
                               :class="{'is-danger': form.errors.has('description')}">
                        <span class="help is-danger" v-show="form.errors.has('description')">
                            {{ form.errors.get('description') }}
                        </span>
                    </p>
                </form>
            </div>
        </section>
        <footer class="modal-card-foot">
            <button type="submit" class="button is-primary"
                    @click.prevent="create"
                    :disabled="form.busy">
                Create
            </button>
          <a class="button" @click="$emit('close')">Cancel</a>
        </footer>
      </div>
    </div>
</template>

<script>
    export default {
        props: ['user'],

        data() {
            return {
                showNewShelfModal: false,
                form: new AppForm({
                    name: '',
                    description: '',
                    cover: '',
                })
            };
        },

        methods: {

            close() {
                this.form.errors.forget();
                this.form.name = '';
                this.form.description = '';
            },

            create() {
                App.post('/shelves', this.form)
                    .then(() => {
                        this.$emit('close');
                        this.showCreateSuccessMessage();
                        this.close();
                    });
            },

            showCreateSuccessMessage() {
                swal({
                    title: 'Success!',
                    text: 'Your bookshelf was successfully created!',
                    type: "success",
                    showConfirmButton: false,
                    timer: 2000
                });
            },

        }
    }
</script>
