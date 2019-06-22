<li class="nav-item">
	<a class="nav-link" href="{{url_locale('cart')}}">
		{{icon(config('maguttiCms.store.cart.icon'))}}
		<span class="cart-count badge badge-primary">{{StoreHelper::getCartItemCount()?: ''}}</span>
	</a>
</li>
