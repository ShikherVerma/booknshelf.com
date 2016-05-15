Vue.component('activity-log', {
    props: ['user'],


    data() {
        return {
            activities: [],
            activitiesLoaded: false
        };
    },


    created() {
        this.getActivities();
    },


    methods: {
        getActivities() {
            this.$http.get('/api/activity')
                .then(response => {
                    this.activities = response.data;

                    this.activitiesLoaded = true;
                });
        }
    }
});
