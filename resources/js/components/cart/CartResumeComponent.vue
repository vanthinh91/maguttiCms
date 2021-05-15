<template>

  <div class="container mb-5" v-if="this.items.length==0">
    <div class="row">
      <div class="col-12">
        <alert-box class="alert-info">
          <template #content>
            <h5>{{ $t('store.cart.empty') }}</h5>

          </template>
        </alert-box>
      </div>
    </div>
  </div>
  <div v-else class="table-responsive">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-9">
          <div class="card card__cart box-shadow">


            <div class="table-responsive">
            <table class="table table-hover table-striped cart-resume ">
              <thead>
              <tr>

                <th >{{ $t('store.cart.table.name') }}</th>
                <th class="width-10">{{ $t('store.cart.table.quantity') }}</th>
                <th class="cart__product-price">{{ $t('store.cart.total') }}</th>
                <th class="cart__product-action"><span class="d-none d-lg-block">{{ $t('store.cart.table.actions') }}</span></th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="(item,index) in items" :key="index">

                <td class="product-description">
                  <div class="d-flex justify-content-start">
                    <a :href="item.product.url" class="d-none d-md-block"><img :src="item.product.thumb_image"></a>
                    <div class="ml-1">
                      {{ item.product.code }} - {{ item.product.title }}
                      <product-price :product="item.product"/>
                    </div>
                  </div>


                </td>
                <td class="product-quantity">
                  <!--<input
                      type="number"
                      v-model.lazy="item.quantity"
                      autocomplete="off"
                      v-bind:min="1"
                      @keyup="updateCartItem(item.quantity,item)"
                      @change="updateCartItem(item.quantity,item)"
                  >-->

                  <number-input
                      :hideDecreaseBtn="false"
                      :hideIncreaseBtn="false"
                      :qty="parseInt(item.quantity)"
                      :min="1" v-model="item.quantity" class="input-group-sm "
                      @changeQuantity="updateCartItem(item.quantity,item)"
                      @keyup="updateCartItem(item.quantity,item)"
                  />
                </td>

                <td>
                  <div class="product-price-total">
                    {{ itemTotal(item) | currency }}
                  </div>
                </td>
                <td class="text-center product-action">
                  <i class="fas fa-trash" @click="deleteCartItem(index,item.id)"></i>
                </td>
              </tr>
              </tbody>
            </table>
            </div>
          </div>
        </div>

        <div class="col-12 col-md-3">
          <div class="card cart-summary box-shadow p-2">

            <div class="cart-summary-line cart-item">
              <span class="label">{{ number_of_items }} {{ $t('store.cart.number_of_items') }} </span>
              <span class="value">{{ product_total | currency }}</span>
            </div>
            <div class="cart-summary-line cart-discount" v-if="discount_amount">
              <span class="label">{{ $t('store.order.discount.title') }}<br><strong>{{ cart.discount_label }}</strong></span>
              <span class="value">{{ discount_amount | currency }}<br><a href="" @click.prevent="deleteCartCoupon" class="text-danger">{{ $t('store.order.discount.delete') }}</a></span>
            </div>

            <div class="cart-summary-line cart-ship" v-if="shipping_cost">
              <span class="label">{{ $t('store.order.shipping_cost') }}</span>
              <span class="value">{{ shipping_cost | currency }}</span>
            </div>
            <div class="cart-summary-totals">
              <div class="cart-summary-line cart-total">
                <span class="label">{{ $t('store.cart.total') }}&nbsp;({{ $t('store.cart.with_tax') }})</span>
                <span class="value">{{ total | currency }}</span>
              </div>
            </div>
            <a class="btn btn-accent mt-2" :href="this.cart_url">{{ $t('store.cart.buy') }}</a>
          </div>
          <coupon-component></coupon-component>
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import cartHelper from './mixins/store';
import alertBox from '../BaseComponent/AlertComponent';
import CouponBox from './CouponComponent';
import numberInput from '../BaseComponent/InputNumberComponent'
import CouponComponent from "./CouponComponent";
import ProductPrice from "./partial/DisplayPriceComponent"

export default {
  mixins: [cartHelper],
  props: ['cartItems','cartData','cart_url'],
  components: {CouponComponent, alertBox, numberInput,CouponBox,ProductPrice},
  data() {
    return {
      name: '1',
      items: {},
      cart: {},
    }
  },
  created() {
    this.items = this.cartItems;
    this.cart = this.cartData;
  },
  computed: {
    product_total: function () {
      let total = 0;
      return this.items.reduce((total, p) => {
        return total + p.product.price * Math.abs(Math.ceil(p.quantity))
      }, total)
    },
    total: function () {
      return this.shipping_cost + this.product_total-this.discount_amount;
    },
    shipping_cost: function () {
      return (this.product_total < 100) ? 0 : 0;
    },
    discount_amount: function () {
      return (this.cart.discount_amount)? this.calculateDiscount(this.product_total):0;
    },
    number_of_items: function () {
      let n_items = 0;
      return this.items.reduce((n_items, p) => {
        this.updateItemQuantity(p.quantity,p.id);
        return n_items += Math.ceil(p.quantity);
      }, n_items)
    },
  },
  methods: {
    updateCartItem(q = 1, item) {
      if (typeof q !== 'number' || isNaN(q) || q < 1) q = 1;
      item.quantity = q;
      this.updateItemQuantity(q, item.id)
    },
    deleteCartItem(index, id) {
      let items = this.items
      let self = this;
      bootbox.setLocale(window._LANG);
      bootbox.confirm("<h5>" + this.$t('store.items.are_you_sure_to_remove') + "</h5>", function (confirmed) {
        if (confirmed) {
          items.splice(index, 1);
          self.deleteItem(id)
        }
      });
    },
    deleteCartCoupon() {
      let self = this;
      bootbox.setLocale(window._LANG);
      bootbox.confirm("<h5>" + this.$t('store.order.discount.are_you_sure_to_remove') + "</h5>", function (confirmed) {
        if (confirmed) {
          self.removeDiscount();
        }
      });
    },
    updateCoupon(){
      this.cart.discount_amount=0;
      this.cart.discount_code="";
    },
    itemTotal(item) {
      return item.product.price * Math.abs(Math.ceil(item.quantity));
    }
  }
}
</script>
