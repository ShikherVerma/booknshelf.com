<template>
    <section class="section">
        <div class="container">
            <div class="columns is-multiline">
                <topic v-for="topic in topics" :topic="topic" :user="user" :user-topics="userTopics"></topic>
                <div class="column is-half">
                    <article class="media hvr-glow" style="padding: 20px;">
                        <figure class="media-left">
                        </figure>
                        <div class="media-content">
                            <div class="content">
                                <strong>Help me by suggesting a topic you would like to see in
                                    here.
                                </strong>
                            </div>
                            <nav class="level">
                                <div class="level-left">
                                    <p class="level-item has-text-centered">
                                        <a href="https://goo.gl/forms/CcCU1KSpmqFJeHzB3" type="button" target="_blank"
                                           class="button hvr-glow is-primary is-large"
                                           style="background-color: #1c51a6; color: white;">
                                                <span class="icon">
                                                  <i class="fa fa-smile-o"></i>
                                                </span>
                                            <span>Suggest your topic</span>
                                        </a>
                                    </p>
                                </div>
                            </nav>
                        </div>
                        <div class="media-right">
                        </div>
                    </article>
                </div>
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
</style>
