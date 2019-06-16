<template>
    <modal name="dialog">
        {{ params.message }}
        {{ params.item }}

        <template v-slot:footer>
            <button
                class="btn btn-danger mr-2"
                @click.prevent="handleClick(false)"
                v-if="params.cancelButton"
                v-text="params.cancelButton"
            >
            </button>

            <button
                class="btn btn-default"
                @click.prevent="handleClick(true)"
                v-if="params.confirmButton"
                v-text="params.confirmButton"
            >
            </button>
        </template>
    </modal>
</template>

<script>
    import Modal from '../../plugins/modal/ModalPlugin';

    export default {
        data() {
            return {
                params: {
                    message: 'Are you sure?',
                    confirmButton: 'Continue',
                    cancelButton: 'Cancel',
                    item: ''
                }
            };
        },

        beforeMount() {
            Modal.events.$on('show', params => {
                Object.assign(this.params, params);
            });
        },

        methods: {
            handleClick(confirmed) {
                Modal.events.$emit('clicked', confirmed);
                this.$modal.hide();
            }
        }
    }
</script>
