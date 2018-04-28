<script>
    export default {
        name: 'modal',
        methods: {
            close() {
                this.$emit('close');
            },
            update : function () {
               this.$emit('update');
            },
        },
        template: require('../template/modal.html'),
    };
</script>


