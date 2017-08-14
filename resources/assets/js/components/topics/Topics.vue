<template>
    <section class="section topics-section">
        <div class="container">
            <div class="columns is-multiline">
                <topic v-for="topic in topics" :topic="topic" :user="user" :user-topics="userTopics"></topic>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['topics', 'user', 'userTopics'],
    }
</script>

<style lang="css">
    .topics-section {
        padding-top: 10px;
    }
</style>
