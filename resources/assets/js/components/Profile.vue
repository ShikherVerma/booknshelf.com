<template>
  <div class="profile-header text-center">
    <div class="container">
        <div class="container-inner">
            <div class="photo-container-inner">
                <img class="img-circle media-object profile-photo" :src="user.avatar">
            </div>
                <h3 class="profile-header-user">{{ user.name }}</h3>
                <p class="profile-header-bio">
                    {{ user.about }}
                </p>
            </div>
        </div>

        <table class="table table-striped">
            <tr>
                <td>Bookshelves</td>
            </tr>
        </table>

<!--         <nav class="profile-header-nav">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#bookshelves" aria-controls="bookshelves" role="tab" data-toggle="tab">
                        BOOKSHELVES
                    </a>
                </li>
            </ul>
        </nav> -->
  </div>
</template>

<script>
    export default {
        props: ['user'],

        mounted() {
            console.log('Component ready.')
        }
    }
</script>

<style lang="sass">
    .photo-container-inner {
        display: flex;
    }
    .profile-photo {
        margin: auto;
    }
    .profile-header-nav .nav {
        display: inline-block;
        border-bottom: 0;
    }
</style>
