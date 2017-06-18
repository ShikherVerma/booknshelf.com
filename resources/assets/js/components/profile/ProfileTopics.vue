<template>
    <div class="container">
        <div v-if="topics.length < 1" class="columns">
            <div class="column is-half">
                <div class="message is-primary">
                    <div class="message-body">
                        <p class="title has-text-centered">
                          <span class="icon is-large">
                            <i class="fa fa-picture-o"></i>
                          </span>
                        </p>
                        <h3 class="title has-text-centered" style="color: dimgray;">
                            You haven't followed any topics yet.
                        </h3>
                        <p class="subtitle has-text-centered" style="color: dimgray;">
                            Topics are curated by us. When we add new books to the topics
                            you follow you will get notified.
                        </p>
                        <p class="subtitle has-text-centered">
                            <a href="/topics" class="button is-medium is-primary">Start following topics</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="columns is-multiline">
            <topic v-for="topic in topics" :topic="topic" :user="user" :user-topics="userTopics"></topic>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'topics', 'userTopics'],
    }
</script>