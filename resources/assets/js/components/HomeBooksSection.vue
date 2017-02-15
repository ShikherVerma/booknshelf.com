<template>
    <section class="section">
        <div class="container">
            <div class="notification">
                <div class="title is-4">
                    {{ title }}
                    <a href="/books/search?q=how to win friends">Search More ></a>
                </div>
            </div>
            <div class="columns is-multiline">
                <book v-for="book in books" :book="book" :user="user" :likes="likes" :saves="saves"></book>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['books', 'user', 'likes', 'saves', 'title'],
    }
</script>

<style lang="css">
</style>



