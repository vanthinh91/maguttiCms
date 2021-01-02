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
                <th colspan="2">{{ $t('store.cart.table.name') }}</th>
                <th class="width-10">{{ $t('store.cart.table.quantity') }}</th>
                <th class="width-10">{{ $t('store.cart.total') }}</th>
                <th class="width-10 text-center">{{ $t('store.cart.table.actions') }}</th>
              </tr>
              </thead>
              <tbody>
              <tr v-for="(item,index) in items" :key="index">
                <td><a :href="item.product.url"><img :src="item.product.thumb_image"></a></td>
                <td>
                  {{ item.product.code }}<br>
                  {{ item.product.title }}<br>
                  <span class="product-price">{{ item.product.price | currency }}</span>
                </td>
                <td style="width:100px">
                  <!--<input
                      type="number"
                      v-model.lazy="item.quantity"
                      autocomplete="off"
                      v-bind:min="1"
                      @keyup="updateCartItem(item.quantity,item)"
                      @change="updateCartItem(item.quantity,item)"
                  >-->

                  <number-input
                      :hideDecreaseBtn="true"
                      :hideIncreaseBtn="true"
                      :qty="parseInt(item.quantity)"
                      :min="1" v-model="item.quantity" class="input-group-sm "
                      @changeQuantity="updateCartItem(item.quantity,item)"
                      @change="updateCartItem(item.quantity,item)"
                  />
                </td>

                <td>
                  <div class="product-price-total">{{ itemTotal(item) | currency }}</div>
                </td>
                <td class="text-center"><i class="fas fa-trash" @click="deleteCartItem(index,item.id)"></i></td>
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
            <div class="cart-summary-line cart-ship">
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
        </div>
      </div>
    </div>
  </div>

</template>

<script>
import cartHelper from './mixins/store';
import alertBox from '../BaseComponent/AlertComponent';
import numberInput from '../BaseComponent/InputNumberComponent'

export default {
  mixins: [cartHelper],
  props: ['cartItems', 'cart_url'],
  components: {alertBox, numberInput},
  data() {
    return {
      name: '1',
      items: {},
    }
  },
  created() {
    this.items = this.cartItems;
  },
  computed: {
    product_total: function () {
      let total = 0;
      return this.items.reduce((total, p) => {
        return total + p.product.price * Math.abs(Math.ceil(p.quantity))
      }, total)
    },
    total: function () {
      return this.shipping_cost + this.product_total;
    },
    shipping_cost: function () {
      return (this.product_total < 100) ? 10 : 0;
    },
    number_of_items: function () {
      let n_items = 0;
      return this.items.reduce((n_items, p) => {
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
    itemTotal(item) {
      return item.product.price * Math.abs(Math.ceil(item.quantity));
    }
  }
}
</script>
