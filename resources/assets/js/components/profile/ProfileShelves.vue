<template>
    <div class="container" data-grid="images">
        <div class="row">
            <profile-shelf v-for="shelf in shelves" :shelf="shelf" :user="user"></profile-shelf>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelves'],
    }
</script>

<style>
</style>
