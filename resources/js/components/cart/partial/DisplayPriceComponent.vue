<template>
  <div class="cart__product-box">
    <del class="cart__price-full mr-1"
         v-if="product.full_price">{{ product.full_price }}</del>
    <span class="cart__product-price">{{ product.price }}</span>
  </div>
</template>

<script>
export default {
  name: "DisplayPriceComponent",
  props: {
    product: {
      type: Object,
      required:true
    },
  },
}
</script>

