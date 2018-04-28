<script>
    import collection from '../mixins/collection';
    export default {
        props: ['list', 'name', 'value'],
        data: function () {
            return {
                active: true,
            }
        },
        mounted() {
            this.active = this.value;
        },
        mixins: [collection],
        methods: {
            toggleBtn: function () {
                this.active = (this.active == 1) ? 0 : 1;
                let itemArray = this.list.split('_');
                let url = window.urlAjaxHandlerCms + 'update/updateItemField/' + itemArray[0] + '/' + itemArray[1];
                axios.get(url,
                    {
                        params: {
                            model: itemArray[0],
                            field: this.name,
                            value: this.active
                        }
                    }
                )
                    .then(response => this.simpleAjaxResponse(response))
                    .catch(error => this.responseWithError(error));
            }
        },
        template: '<div v-on:click.prevent="toggleBtn">' +
            '<i v-if="active==1" class=" transitioned fa fa-2x fa-check text-success pointer"></i>' +
            '<i v-else  class=" transitioned fa fa-2x fa-close text-error  pointer"></i>' +
            '<slot></slot>' +

        '</div>'
    }
</script>
