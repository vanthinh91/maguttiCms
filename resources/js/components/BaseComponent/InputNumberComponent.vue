<template>
    <div class="input-group">
        <div class="input-group-prepend" @click="decrease" v-if="!hideDecreaseBtn">
            <span class="input-group-text">-</span>
        </div>
        <input type="number"
               :min="min"
               :max="max"
               :step="step"
               v-model.number="quantity "
               @change="change"
               @paste="paste"
               autocomplete="off"
               class="form-control text-center"
               v-on:input="$emit('input', $event.target.value)"
        >
        <div class="input-group-append" @click="increase" v-if="!hideIncreaseBtn">
            <span class="input-group-text">+</span>
        </div>
    </div>
</template>
<script>

    export default {
        props: {
            max: {
                type: Number,
                default: Infinity,
            },
            min: {
                type: Number,
                default: 1,
            },
            step: {
                type: Number,
                default: 1,
            },
            qty: {
                type: Number,
                default: 1,
            },
            hideDecreaseBtn: {
                type: Boolean,
                default: false,
            },
            hideIncreaseBtn: {
                type: Boolean,
                default: false,
            },

        },
        data() {
            return {
                quantity: {
                    type: Number,
                    default: 1,
                },
                modalOpen: false,
                modalContent :{},
                item: {},
            }
        },
        created() {
            this.quantity = this.qty;

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
                    quantity -= this.step;
                }
                if(quantity < this.min) quantity= this.min;
                //else this.disabele = true

                this.quantity = quantity
                this.emitEvent();
            },
            increase() {
                let {quantity} = this;
                if (isNaN(quantity)) {
                    quantity = this.min;
                }
                quantity += 0.5;
                if (quantity > this.max) {
                    quantity=this.max;
                }
                this.quantity= quantity;
                this.emitEvent();
            },

            round(value, step) {
                step || (step = 1.0);
                let inv = 1.0 / step;
                return Math.round(value * inv) / inv;
            },


            emitEvent(){
                this.quantity= this.round(this.quantity,this.step);
                this.$emit('input', this.quantity);
                this.$emit('changeQuantity',this.quantity)
            },
            change(event) {


                this.quantity = Math.min(this.max, Math.max(this.min, event.target.value));
                this.quantity=this.round(this.quantity,this.step)
                this.emitEvent();
            },
            paste(event) {
                this.quantity = Math.min(this.max, Math.max(this.min, event.target.value));
                //this.quantity=this.round(this.quantity,this.step)
                this.emitEvent();
            },

        }

    }
</script>