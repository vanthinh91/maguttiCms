<template>
    <div class="form col-6">
        <div class="input-group">
            <div class="input-group-prepend" @click="decrease">
                <span class="input-group-text">-</span>
            </div>
            <input type="number"
                   v-model="quantity" :min="min"
                   @change="change"
                   @paste="paste"
                   autocomplete="off" class="form-control text-center" aria-label="Amount (to the nearest dollar)">
            <div class="input-group-append" @click="increase">
                <span class="input-group-text">+</span>
            </div>
        </div>

        <a href="#" class="btn btn-primary my-1 btn-block" @click="addProductToCart">
            <slot name="label"></slot>
        </a>
    </div>
</template>

<script>
    import cartHelper  from '../../mixins/store';
    export default {
        mixins: [cartHelper],
        props: {
            product: Object,
            max: {
                type: Number,
                default: Infinity,
            },
            min: {
                type: Number,
                default: -Infinity,
            }
        },
        data() {
            return {
                quantity: 1,
            }
        },
        created() {
            this.quantity = this.min;
        },
        methods: {
            url() {
                return `${this.baseUrl}cart-item-add`;
            },
            decrease() {
                let {quantity} = this;
                if (isNaN(quantity)) {
                    quantity = this.min;
                }
                if (quantity > this.min) {
                    quantity--;
                }
                else this.disabele=true

                this.quantity = quantity
            },
            increase() {
                let {quantity} = this;
                if (isNaN(quantity)) {
                    quantity = this.min;
                }
                if (quantity == this.max) {
                    quantity--;
                }
                this.quantity++;
            },
            change(event) {
                this.quantity = Math.min(this.max, Math.max(this.min, event.target.value));

            },
            paste(event) {
                this.quantity = Math.min(this.max, Math.max(this.min, event.target.value));
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
