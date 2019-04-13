<script>

    import {HTTP} from '../mixins/http-common';
    import helper     from '../mixins/helper';
    export default {
        data: () => ({
            topicElements: []
        }),
        mixins: [helper],

        template: require('../admin/template/side-bar.html'),
        // Fetches posts when the component is created.
        created() {
            this.fetchData();
        },
        computed: {

        },
        filters: {

        },
        methods: {
            fetchData: function () {
               var self = this;
               return HTTP.get(this.url())
                    .then(this.refresh)
                    .catch(e => {
                        self.errors.push(e)
                        self.showMessage(e.message,self.ERROR_CLASS);
                    })
            },
            url() {
               return `/tag?limit=100`;
            },
            refresh({data}) {
                this.topicElements = data.data.data
                this.topicElements.sort()
            },

        }
    }
</script>
