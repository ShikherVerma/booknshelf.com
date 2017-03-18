<template>
    <div class="container">
        <div v-if="likes.length < 1" class="columns">
            <div class="column is-half">
                <div class="message is-primary">
                  <div class="message-body">
                      <p class="title has-text-centered">
                          <span class="icon is-large">
                            <i class="fa fa-heart-o"></i>
                          </span>
                      </p>
                      <h3 class="title has-text-centered" style="color: dimgray;">
                          You haven't liked any books yet.
                      </h3>
                      <p class="subtitle has-text-centered" style="color: dimgray;">
                          When you start liking books they will appear here and people can see the books you read and liked.
                      </p>
                      <p class="subtitle has-text-centered">
                          <a href="/#favorite-books" class="button is-medium is-primary">Check our favorite books</a>
                      </p>
                  </div>
                </div>
            </div>
        </div>
        <div v-else class="columns is-multiline">
            <book v-for="book in books" :book="book" :user="user" :likes="likes" :saves="saves"></book>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'books', 'likes', 'saves'],
    }
</script>
<style lang="css">
    .message-body a {
         text-decoration: none !important;
    }
</style>