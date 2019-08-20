<template>
    <div class="form col-12 col-md-6">
        <number-input :min="this.min" v-model="quantity"/>
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
    import numberInput from '../BaseComponent/InputNumberComponent'
    export default {
        components: {confirmModal,numberInput},
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
            },
            value: {
                type: Number,
                default: 1,
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
            this.quantity = (this.value)?this.value:this.min;
        },
        methods: {
            url() {
                return `${this.baseUrl}cart-item-add`;
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
