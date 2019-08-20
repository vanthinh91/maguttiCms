<template>
    <div class="form col-12 col-md-6">
        <div class="input-group">
            <div class="input-group-prepend" @click="decrease">
                <span class="input-group-text">-</span>
            </div>
            <input type="number"
                   v-model.number="quantity" :min="min"
                   @change="change"
                   @paste="paste"
                   autocomplete="off" class="form-control text-center">
            <div class="input-group-append" @click="increase">
                <span class="input-group-text">+</span>
            </div>
        </div>
        <a href="#" class="btn btn-primary my-1 btn-block" @click.prevent.stop="addProductToCart">
            <slot name="label"></slot>
        </a>

        <confirm-modal
                :show="modalOpen"
                @close="modalOpen = false"
        >
            <template #modal-header>{{$t('store.alerts.add_success')}}</template>
            <template #modal-body>
                <div class="shopping-cart-item-preview d-flex my-2">
                    <img :src="product.thumb_image" class="shopping-cart-image-preview">
                    <div class="shopping-cart-item-body-preview ml-1">
                        <b>{{ product.code}} - {{product.title}}</b>
                        <div>Qt:{{product.quantity}}</div>
                        <div>{{$t('store.cart.table.price')}}: {{product.price * product.quantity | currency}} ({{product.price}})</div>
                    </div>
                </div>
            </template>
            <template #modal-footer="{closeModal}">
                <button @click.prevent="gotToCart" type="button" class="btn btn-success btn-block">
                    {{$t('store.cart.checkout')}}
                </button>
                <button @click="closeModal" type="button" class="btn btn-warning btn-block">
                    {{$t('store.cart.continue')}}
                </button>
            </template>
        </confirm-modal>
    </div>
</template>
<script>
    import cartHelper  from './mixins/store';
    import confirmModal from '../BaseComponent/ModalComponent'
    export default {
        components: {confirmModal},
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
                modalOpen: false,
                modalContent :{},
                item: {},
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
            updateModal(cart_items){
                this.item =cart_items.find(obj => obj.product_code == this.product.code)
                this.product.quantity=this.item.quantity;
                this.product.thumb_image=this.item.product.thumb_image;
            }
        },
        mounted() {
            window.$cartBus.$on('ADD_ITEM_TO_CART', ({cart_count,cart_items}) => {
                this.counterItems = cart_count;
                this.updateModal(cart_items)
            })
        }
    }
</script>
