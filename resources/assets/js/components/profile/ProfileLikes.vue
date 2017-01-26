<template>
    <div class="container">
        <div class="columns is-multiline">
            <search-book v-for="like in likes" :book="like.book" :likeUserId="like.user_id" :user="user"></search-book>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'likes']
    }
</script>