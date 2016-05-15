Vue.component('spark-update-password', {

    /**
     * The component's data.
     */
    data() {
        return {
            form: new SparkForm({
                current_password: '',
                password: '',
                password_confirmation: ''
            })
        };
    },


    methods: {
        /**
         * Update the user's password.
         */
        update() {
            Spark.put('/settings/password', this.form);
        }
    }

});
