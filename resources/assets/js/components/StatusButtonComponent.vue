<script>
    export default {
        mounted() {
            console.log('Click Component mounted.')
        },
        props: ['list', 'name', 'is_active'],
        data: function () {
            return {
                counter: 0,
                active:0,
            }
        },
        created: function () {
            this.active = this.is_active;
        },
        methods: {
            toogleBtn: function () {
                this.active=!this.active
                alert(this.list+' '+this.active)
            }
        },
        template: '<div v-on:click.prevent="toogleBtn">' +
        '<i v-if="active==1" class=" transitioned fa fa-2x fa-check text-success pointer"></i>' +
        '<i v-else  class=" transitioned fa fa-2x fa-close text-error  pointer"></i>' +
        '</div>'
    }
</script>
