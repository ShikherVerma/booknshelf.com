<template>
    <div class="col-md-3">
        <a :href="url">
            <div class="card card-background">
    			<div class="content">
                    <h2 class="card-title">{{ shelf.name }}</h2>
                    <label class="label label-primary">10 Books</label>
    			</div>
    		</div>
        </a>
    </div>
</template>

<script>
    export default {
        props: ['user', 'shelf'],
        mounted() {},
        computed: {
            url: function() {
                return '/@' + this.user.username + '/shelves/' + this.shelf.slug
            }
        }
    }
</script>

<style>
</style>