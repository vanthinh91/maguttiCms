<template>
    <div class="form-inline">
        <input class="form-control cart-item-quantity mr-2 my-1" type="number" v-model="quantity" :min="min"
               autocomplete="off">
        <a href="#" class="btn btn-primary my-1" @click="addProductToCart">
            <slot name="label"></slot>
        </a>
    </div>
</template>

<script>
    import cartHelper  from '../../mixins/store';
    export default {
        mixins: [cartHelper],
        props: ['product', 'min', 'max'],
        data() {
            return {
                quantity: 1
            }
        },
        created() {
            this.quantity = this.min;
        },
        methods: {
            url() {
                return `${this.baseUrl}cart-item-add`;
            },
        },
        mounted() {
            window.$cartBus.$on('ADD_ITEM_TO_CART', ({cart_count,cart_items}) => {
                this.counterItems = cart_count;
                this.items = cart_items;
            })
        }
    }
</script>
