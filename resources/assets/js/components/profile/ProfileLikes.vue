<template>
    <div class="container">
        <div class="columns is-multiline">
            <profile-like-book v-for="book in books" :book="book" :user="user" :likes="likes"></profile-like-book>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'books', 'likes'],
    }


</script>