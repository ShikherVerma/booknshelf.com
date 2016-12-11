<template>
    <div class="container m-y-md shelf-books" data-grid="images">
        <div class="row">
            <shelf-book v-for="book in books" :book="book" :user="user"></shelf-book>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'books'],
    }
</script>

<style>
</style>
