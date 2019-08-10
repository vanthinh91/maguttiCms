<script>

    import {HTTP} from '../../mixins/http-common';
    import helper from '../../mixins/helper';

    export default {
        mixins: [helper],
        template: require('../admin/template/side-bar-item.html'),
        props: ['item', 'currentSection'],
        // Fetches posts when the component is created.
        created() {
            this.setOpen();
        },
        data() {
            return {
                open: false,
            }
        },
        mounted() {
            console.log('Side Bar sub menu mounted.')

        }, methods: {
            fetchData: function () {
                let self = this;
                return HTTP.get(this.url())
                    .then(this.refresh)
                    .catch(e => {
                        self.errors.push(e);
                        self.showMessage(e.message, self.ERROR_CLASS);
                    })
            },
            url() {
                return '/admin/api/nav-bar';
            },
            refresh({data}) {
                this.items = data.data
            },
            setOpen() {
                let open = false;
                let section = this.currentSection;
                this.item.submenu.forEach(function (item) {
                    if(item.section===section) open=true;
                    console.log(item.section+' '+section)
                });
                this.open=open
            },
        },

    }
</script>
