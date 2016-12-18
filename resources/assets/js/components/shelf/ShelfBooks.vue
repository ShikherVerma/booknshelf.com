<template>
    <div class="container m-y-md shelf-books">
        <div class="row">
            <shelf-book v-for="book in books" :book="book" :user="user" :shelf="shelf"></shelf-book>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'books', 'shelf'],
    }
</script>

<style>
</style>
