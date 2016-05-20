Vue.component('home', {
    props: ['user'],


    data() {
        return {
            tasks: [],

            form: new AppForm({
                name: ''
            })
        };
    },


    created() {
        this.getTasks();
    },


    methods: {
        getTasks() {
            this.$http.get('/api/tasks')
                .then(response => {
                    this.tasks = response.data;
                });
        },


        create() {
            App.post('/api/task', this.form)
                .then(task => {
                    this.tasks.push(task);

                    this.form.name = '';
                });
        },


        delete(task) {
            this.$http.delete('/api/task/' + task.id);

            this.tasks = _.reject(this.tasks, t => t.id == task.id);
        }
    }
});
