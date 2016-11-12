import Vue from 'vue/dist/vue.min.js'
import App from './app.vue'


// new Vue({
//   el: '#apptest',
//   components: { App }
// })

new Vue({
  el: '#apptest',
  render: h => h(App)
})

// Vue.component('app-home', {
//
//     // template: '<div>A custom component!</div>',
//
//     // props: ['shelves', 'books'],
//
//     data: function() {
//         return {
//             counter: 0
//         }
//     },
//
//     // created() {
//     //     this.books = JSON.parse(this.books);
//     //     this.shelves = JSON.parse(this.shelves);
//     // },
//
// });
