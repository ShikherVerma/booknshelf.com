<template>
    <div class="container">
        <div class="columns is-multiline">
            <book v-for="book in books" :book="book" :user="user" :likes="likes" :saves="saves"></book>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'books', 'likes', 'saves'],
    }


</script>