<template>
    <div class="modal is-active">
      <div class="modal-background" @click="$emit('close')"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Edit Bookshelf</p>
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
            <button type="submit" class="button is-danger"
                    @click.prevent="deleteShelf">
                Delete bookshelf
            </button>
            <button type="submit" class="button is-primary"
                    @click.prevent="updateShelf"
                    :disabled="form.busy">
                Save
            </button>
            <button class="button is-light" @click="$emit('close')">Cancel</button>
        </footer>
      </div>
    </div>
</template>

<script>
    export default {
        props: ['shelf', 'user'],

        data() {
            return {
                showEditShelfModal: false,
                form: new AppForm({
                    name: this.shelf.name,
                    description: this.shelf.description
                }),
                deleteShelfForm: new AppForm({}),
            };
        },


        methods: {

            close() {
                this.form.errors.forget();
                this.form.name = '';
                this.form.description = '';
            },

            /**
             * Initialize the edit form with the given shelf.
             */
            initializeUpdateFormWith(shelf) {
                this.form.name = shelf.name;
                this.form.description = shelf.description;
            },


            /**
             * Update the shelf being edited.
             */
            updateShelf() {
                App.put(`/shelves/${this.shelf.id}`, this.form)
                    .then(() => {
                        this.shelf.name = this.form.name;
                        this.shelf.description = this.form.description;
                        this.$emit('close');
                    })
            },

            /**
             * Delete the specified shelf.
             */
            deleteShelf() {
                App.delete(`/shelves/${this.shelf.id}`, this.deleteShelfForm)
                    .then(() => {
                        window.location.replace(`/@${this.user.username}`);
                    });
            },
        },

    }
</script>
