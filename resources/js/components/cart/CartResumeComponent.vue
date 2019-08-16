<template>
    <div class="container">
        <alert-box v-if="this.items.length==0" class="alert-info">
            <template #content><h5>{{$t('store.cart.empty')}}</h5></template>
        </alert-box>
        <table v-else class="table">
            <thead>
            <tr>
                <th class="width-10"></th>
                <th class="width-10">{{$t('store.cart.table.code')}}</th>
                <th>{{$t('store.cart.table.name')}}</th>
                <th class="width-10">{{$t('store.cart.table.quantity')}}</th>
                <th class="width-10">{{$t('store.cart.table.price')}}</th>
                <th class="width-10">{{$t('store.cart.table.actions')}}</th>
            </tr>
            </thead>
            <tr v-for="(item,index) in items">
                <td>Image</td>
                <td>
                    {{item.product.code}}
                </td>
                <td>
                    {{item.product.title}}
                </td>
                <td>
                    <input
                            type="number"
                            class="cart-item-quantity"
                            v-model="item.quantity"
                            autocomplete="off"
                            v-bind:min="1"
                            @change="updateCartItem(item.quantity,item.id)"
                    >
                </td>
                <td>{{item.product.price | currency}}</td>
                <td>{{item.product.price*item.quantity | currency}}</td>
                <td class="text-center"><i class="fas fa-trash" @click="deleteCartItem(index,item.id)"></i> </td>
            </tr>
            <tfoot>
            <tr>
                <th></th>
                <th>{{$t('store.cart.total')}}</th>
                <th></th>
                <th></th>
                <th>{{ total | currency  }}</th>
                <th></th>
                <th></th>
            </tr>
            </tfoot>
        </table>
    </div>
</template>

<script>
    import cartHelper  from '../../mixins/store';
    import alertBox from '../BaseComponent/AlertComponent';
    export default {
        mixins: [cartHelper],
        props: ['cartItems'],
        components: {alertBox},
        data() {
            return {
                name: '1',
                items: {},
            }
        },
        created() {
            this.items = this.cartItems;
        },
        computed:{
            total:function() {
                let total=0;
                total = this.items.reduce((total, p) => {
                    return total + p.product.price * p.quantity
                }, total)

                return `€ ${total}`
            }
        },
        methods: {
            updateCartItem(q,id){
                let cartItem = this.items.find(item => item.id = id );
                this.updateItemQuantity(q,id)
            },
            deleteCartItem(index,id){
                let items = this.items
                let self = this;
                console.log(this.$t('store.items.are_you_sure_to_remove'));
                bootbox.setLocale(window._LANG);
                bootbox.confirm("<h5>"+this.$t('store.items.are_you_sure_to_remove')+"</h5>", function (confirmed) {
                    if (confirmed) {
                        items.splice(index, 1);
                        self.deleteItem(id)
                    }
                });
            }
        }
    }
</script>
