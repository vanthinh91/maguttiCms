<template>
    <div :id="name" class="overlay text-left">
        <a href="#" class="cancel"></a>
        <div class="modal-vue">
            <div class="modal-vue-header mb-4 pb-2">
                <slot name="header"></slot>
            </div>
            <slot></slot>
            <div class="modal-vue-footer pt-4 float-right">
                <slot name="footer"></slot>
            </div>
            <a href="#" class="close">&times;</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['name']
    }
</script>

<style>
    .overlay {
        visibility: hidden;
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, .4);
        transition: opacity .3s;
        opacity: 0;
    }

    .overlay:target {
        visibility: visible;
        opacity: 1;
    }

    .modal-vue {
        position: relative;
        width: 500px;
        max-width: 80%;
        background: white;
        border-radius: 4px;
        padding: 0 2em 2em 2em;
        box-shadow: 0 5px 11px rgba(36, 37, 38, 0.08);
    }

    .modal-vue .close {
        position: absolute;
        top: 15px;
        right: 15px;
        color: grey;
        text-decoration: none;
    }

    .modal-vue .modal-vue-header {
        padding-top:1rem;
        border-bottom:1px solid black;
    }

    .overlay .cancel {
        position: absolute;
        width: 100%;
        height: 100%;
    }
</style>
