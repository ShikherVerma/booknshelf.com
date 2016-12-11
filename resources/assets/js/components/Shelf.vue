<template>
    <div class="profile-header shelf-page-header text-center">
        <div class="container">
            <div class="container-inner">
                <h2 class="profile-header-user">{{ shelf.name }}</h2>
                <p v-if="shelf.description" class="profile-header-bio">
                    {{ shelf.description}}
                </p>
                <span>
                    <img class="img-circle small-profile-photo" :src="user.avatar">
                    <a class="profile-name" :href="profileUrl">
                        {{ user.name }}
                    </a>
                </span>
            </div>
        </div>

        <nav class="profile-header-nav">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#" class="books-count">{{ books.length }} Books</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelf', 'books'],

        computed: {
            profileUrl: function () {
                return '/@' + this.user.username;
            }
        }
    }
</script>

<style lang="sass">
    .shelf-page-header {
        background-color: #F5F5F5
    }

    .profile-header-user {
        color: #072B54;
    }
    .profile-header-bio {
        color: lighten(#072B54, 5%);
    }

    .profile-name {
        font-size: 14px;
    }

    .small-profile-photo {
        height: 35px !important;
        width: 35px !important;
    }

    .books-count {
        color: black !important;
    }
</style>
