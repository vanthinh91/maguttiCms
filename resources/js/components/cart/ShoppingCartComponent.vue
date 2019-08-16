<template>
    <li class="nav-item dropdown shopping-cart">
        <a class="nav-link dropdown-toggle" :href="this.cart_url"
           id="shoppingDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i :class="this.icon"></i>
            <span v-show="this.counterItems" class="cart-count badge badge-primary">{{this.counterItems}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="shoppingDropdownMenuLink">
            <div v-for="(item,index) in this.items" class="dropdown-item" href="#">
                <div class="shopping-cart-item">
                    <img :src="item.product.thumb_image">
                    <div class="shopping-cart-item-body">
                        <b>{{item.product.code}} - {{item.product.title}}</b>
                        <div>QT:{{item.quantity}}</div>
                        <div>Price: {{item.product.price | currency}}</div>
                        <i class="fas fa-trash shopping-cart-delete" @click.prevent.stop="deleteCartItem(index,item.id)"></i>
                    </div>
                </div>
            </div>
            <div class="dropdown-item checkout-link">
                <a v-if="this.counterItems" class="btn btn-warning btn-sm btn-block btn-checkout" :href="this.cart_url">Checkout</a>
                <span v-else class="btn btn-light btn-sm btn-block btn-checkout">Your cart is empty</span>
            </div>

        </div>
    </li>
</template>


<script>
    import cartHelper from '../../mixins/store';

    export default {
        mixins: [cartHelper],
        props: ['icon', 'cart_url', 'counter', 'cartItems'],
        data() {
            return {
                items: {},
                counterItems:0
            }
        },
        created() {
            this.items = this.cartItems;
            this.counterItems = this.counter;
        },
        mounted() {
            window.$cartBus.$on('ADD_ITEM_TO_CART', (payload) => {
                this.updateData(payload);
            });
            window.$cartBus.$on('DELETE_ITEM_FROM_CART', ({cart_count}) => {
                this.counterItems = cart_count;
            })
        },
        methods: {
            deleteCartItem(index, id) {
                let items = this.items
                let self = this;
                bootbox.setLocale(window._LANG);
                bootbox.confirm("<h4>Are you sure?</h4>", function (confirmed) {
                    if (confirmed) {
                        items.splice(index, 1);
                        self.deleteItem(id)
                    }
                });
            },
            updateData({cart_count,cart_items}){
                this.counterItems = cart_count;
                this.items =cart_items;
            }
        }
    }
</script>
