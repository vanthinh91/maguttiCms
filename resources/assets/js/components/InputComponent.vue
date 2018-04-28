<script>
    import collection from '../mixins/collection';
    export default {
        props: ['list', 'name'],
        data: function () {
            return {
                message: ''
            }
        },
        mixins: [collection],

        methods: {
            inputHandler: function () {
                let itemArray = this.list.split('_');
                let url = window.urlAjaxHandlerCms + 'update/updateItemField/' + itemArray[0] + '/' + itemArray[1];
                axios.get(url,
                    {
                        params:{
                            model: itemArray[0],
                            field: this.name,
                            value: this.message
                        }
                    }
                )
                .then(response => this.simpleAjaxResponse(response))
                .catch(error => this.responseWithError(error));
            }
        },
        template: '1111<input v-model="message" type="text" v-on:change.prevent="inputHandler"></input>'
    }
</script>
