<template>
    <transition name="slide-fade">
    <div class="vue-modal-backdrop" v-show="show">
        <div class="vue-modal">
            <h5 class="vue-modal-header">{{$t('store.alerts.add_success')}} !</h5>
            <p class="text-center" v-show="this.item">
                <div class="shopping-cart-item-preview d-flex">
                    <img :src="this.item.product.thumb_image" class="shopping-cart-image-preview">
                    <div class="shopping-cart-item-body-preview ml-1">
                        <b>{{ this.item.product_code}} - {{this.item.product.title}}</b>
                        <div>Qt:{{this.item.quantity}}</div>
                        <div>{{$t('store.cart.table.price')}}: {{this.item.product.price * this.item.quantity | currency}} ({{this.item.product.price}})</div>
                    </div>
                </div>
            </p>
            <div class="text-right">
                <button @click="checkout" type="button" class="btn btn-success btn-block">
                    {{$t('store.cart.checkout')}}
                </button>
                <button @click="dismiss" type="button" class="btn btn-warning btn-block">
                    {{$t('store.cart.continue')}}
                </button>
            </div>
            <i class="fas fa-times fa-1x vue-modal-close" @click="dismiss"></i>
        </div>
    </div>
    </transition>
</template>

<script>
    export default {
        props: ["show",'product_code'],
        data() {
            return {
                item: {},
            }
        },
        created() {
            const escapeHandler = e => {
                if (e.key === "Escape" && this.show) {
                    this.dismiss()
                }
            }
            document.addEventListener("keydown", escapeHandler)
            this.$once("hook:destroyed", () => {
                document.removeEventListener("keydown", escapeHandler)
            })
        },
        methods: {
            dismiss() {
                this.$emit("close")
            },
            checkout() {
                this.$emit("goToCart")
            }
        },
        mounted() {
            window.$cartBus.$on('ADD_ITEM_TO_CART', ({cart_items}) => {
                this.item=cart_items.find(obj => obj.product_code == this.product_code)
            });
        },
    }
</script>
<style>
    .vue-modal-backdrop {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        overflow: auto;
        padding: 2rem;
        background-color: rgba(0, 0, 0, 0.5);
        z-index:20000;
    }
    .vue-modal-header{
        padding:0 0 0.3rem 0;
        margin:0;
        border-bottom: 1px solid #465366;
    }
    .vue-modal {
        position:relative;
        margin-left: auto;
        margin-right: auto;
        max-width: 25rem;
        margin-top: 0rem;

        background-color: #fff;
        border-radius: 0.15rem;
        padding: 1rem 1.5rem;
        -webkit-box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.11),
        0 5px 15px 0 rgba(0, 0, 0, 0.08);
        box-shadow: 0 15px 30px 0 rgba(0, 0, 0, 0.11),
        0 5px 15px 0 rgba(0, 0, 0, 0.08);
    }
    .vue-modal-close{
        position:absolute;
        top:8px;
        right:10px
    }
    .shopping-cart-image-preview{

        width:60px;
        height:60px;
    }
</style>

