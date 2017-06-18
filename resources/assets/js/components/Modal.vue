<template>
    <div class="modal is-active">
      <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-head">
          <p class="modal-card-title">Modal title</p>
          <button class="delete" @click="$emit('close')"></button>
        </header>
        <section class="modal-card-body">
          <!-- Content ... -->
        </section>
        <footer class="modal-card-foot">
          <a class="button is-primary">Save changes</a>
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
                showModal: false
            }
        },

        mounted() {
            console.log('Modal component is ready.')
        },
    }
</script>

<style lang="css">
</style>
