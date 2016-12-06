<template>
    <div class="col-md-3 parent">
        <div class="card card-shelf-book card-background card-raised" :style="bookCoverImage">
            <div class="content">
                <h6 class="category text-info"></h6>
                <h4 class="card-title hover-content">
                    <small>
                        <button class="btn btn-danger btn-sm btn-action" @click="showSaveModal()" type="button">
                            <span class="icon icon-add-to-list"></span> Save
                        </button>
                    </small>
                    <small>
                        <button class="btn btn-success btn-sm btn-action" @click="showSaveModal()" type="button">
                            <span class="icon icon-check"></span> Saved
                        </button>
                    </small>
                    <small>
                        <a class="btn btn-default btn-sm btn-action" :href="book.detail_page_url" target="_blank" type="button">
                            <i class="fa fa-amazon" aria-hidden="true"></i>
                        </a>
                    </small>
                </h4>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['user', 'book'],
        computed: {
            bookCoverImage: function () {
                return `background-image: url(${this.book.cover_image || this.book.image})`;
            }
        }
    }
</script>

<style type="text/css">
    .card-shelf-book {
        text-align: center;
        height: 350px;
        width: 250px;
    }
    .card-shelf-book:after {
        background-color: rgba(0, 0, 0, 0);
    }
    .parent {
      position: relative;
    }
    .hover-content {
      display:none;
      position: absolute;
    }
    .parent:hover .hover-content {
      display: block;
    }
</style>
