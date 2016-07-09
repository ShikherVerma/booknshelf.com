Vue.component('app-books', {
    template: '#books-list',

    props: ['list'],

    created() {
        this.list = JSON.parse(this.list);
        console.log(this.list);
    }
});
