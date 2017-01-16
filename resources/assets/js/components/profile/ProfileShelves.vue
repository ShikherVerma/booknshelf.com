<template>
    <div class="home-container m-t-xs">
        <profile-shelf v-for="shelf in shelves" :shelf="shelf" :user="user"></profile-shelf>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelves'],
    }
</script>

<style lang="css">
    .shelves-container {
        background-color: #00AA88;
    }
</style>
