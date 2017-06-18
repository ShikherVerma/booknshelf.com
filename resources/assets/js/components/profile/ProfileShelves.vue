<template>
    <div class="container">
        <div class="columns is-multiline">
            <profile-shelf v-for="shelf in shelves" :shelf="shelf" :user="user"></profile-shelf>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelves'],
    }
</script>