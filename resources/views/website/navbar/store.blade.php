<li class="nav-item">
	<shopping-cart
			:counter="{{StoreHelper::getCartItemCount()}}"
			cart_url="{{ url_locale('cart') }}"
			icon="fas fa-{{config('maguttiCms.store.cart.icon')}}"
			:cart-items="{{StoreHelper::getCartItems()}}">

	</shopping-cart>
</li>
