<template>
    <button @click="confirm">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            message: {},
            item: {},
            confirmButton: { default: 'Continue' },
            cancelButton: { default: 'Cancel' }
        },

        data() {
            return { confirmed: false };
        },

        methods: {
            confirm(e) {

                if (this.confirmed) {
                    return;
                }
                e.preventDefault();
                this.$modal.dialog(this._props,this._props.item)
                    .then(confirmed => {
                        this.confirmed = confirmed;
                        if (confirmed) {
                            alert(this._props.item)
                            //this.$el.click();
                        }
                    });
            }
        }
    }
</script>
