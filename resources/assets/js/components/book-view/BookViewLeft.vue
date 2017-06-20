<template>
    <book :book="book" :user="user" :likes="likes" :saves="saves"></book>
</template>

<script>
    export default {
        props: ['book', 'user', 'likes', 'saves'],
    }
</script>

<style lang="css">
    .book-view-left {
        /*border-right: solid 1px rgba(144, 144, 144, 0.21);*/
    }

</style>
