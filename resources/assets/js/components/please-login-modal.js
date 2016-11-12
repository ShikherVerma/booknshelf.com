Vue.component('app-please-login-modal', {

    props: [],

    data() {
        return {
            show: false,
            form: new AppForm({
                id: '',
                name: '',
            }),
        }
    },

    methods: {
        close() {
            this.show = false;
            this.form.errors.forget();
        }

    },

    events: {
        showPleaseLoginModal() {
            this.show = true;
        }
    },

    mounted: function () {
        this.$nextTick(function () {
            // code that assumes this.$el is in-document
            document.addEventListener("keydown", (e) => {
                if (this.show && e.keyCode == 27) {
                    this.close();
                }
            });
        })
    }

})