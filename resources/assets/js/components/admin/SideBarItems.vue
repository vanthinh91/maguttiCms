<script>

    import {HTTP} from '../../mixins/http-common';
    import helper from '../../mixins/helper';
    export default {
        mixins: [helper],
        template: require('../admin/template/side-bar-item.html'),
        props: ['item','currentSection'],
        // Fetches posts when the component is created.
        created() {

        },
        data() {
            return {
                open: false
            }
        },
        mounted() {
            console.log('Side Bar sub menu mounted.')
            this.currentSection = this.getCurrentModel();
        }, methods: {
            fetchData: function () {
                var self = this;
                return HTTP.get(this.url())
                    .then(this.refresh)
                    .catch(e => {
                        self.errors.push(e)
                        self.showMessage(e.message, self.ERROR_CLASS);
                    })
            },
            url() {
                return '/admin/api/nav-bar';
            },
            refresh({data}) {
                this.items = data.data
            },
        },

    }
</script>
