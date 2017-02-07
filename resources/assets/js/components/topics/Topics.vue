<template>
    <section class="section">
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

<style lang="sass">
</style>
