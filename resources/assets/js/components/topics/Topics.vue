<template>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <topic v-for="topic in topics" :topic="topic" :user="user"></topic>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['topics', 'user'],
    }

</script>

<style lang="sass">
</style>
