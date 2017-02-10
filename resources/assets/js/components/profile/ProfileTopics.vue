<template>
    <div class="container">
        <div class="columns is-multiline">
            <topic v-for="topic in topics" :topic="topic" :user="user" :user-topics="userTopics"></topic>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'topics', 'userTopics'],
    }
</script>