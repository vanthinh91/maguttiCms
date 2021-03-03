<?php namespace App;

use App\maguttiCms\Domain\Store\OrderPresenter;
use Illuminate\Database\Eloquent\Model;
use	App\maguttiCms\Tools\StoreHelper;

class Order extends Model
{
    use OrderPresenter;
    protected $fillable = [
		'user_id',
		'cart_id',
		'payment_id',
        'reference',
		'products_cost',
		'shipping_cost',
		'discount_amount',
		'vat_cost',
		'total_cost',
		'billing_address_id',
		'shipping_address_id',
        'billing_formatted_address',
        'shipping_formatted_address',
		'discount_code',
        'reference',
		'token',
    ];
    protected $fieldspec = [];

    public $sluggable = [];

	public function cart()
	{
		return $this->belongsTo('App\Cart');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function order_items()
	{
		return $this->hasMany('App\OrderItem');
	}

	public function payment()
	{
		return $this->hasOne('App\Payment');
	}

	public function billing_address()
	{
		return $this->belongsTo('App\Address', 'billing_address_id');
	}

	public function shipping_address()
	{
		return $this->belongsTo('App\Address', 'shipping_address_id');
	}

	public function discount()
	{
		return $this->belongsTo('App\Discount', 'discount_code', 'code');
	}

    function getFieldSpec()
    {
        return $this->fieldspec;
    }

	public function scopeList($query)
	{
		return $query->with(['order_items', 'payment', 'billing_address', 'shipping_address']);
	}

	public function getPermalink()
	{
		return url_locale('/order-review/'.$this->token);
	}

	public function getUserDisplayAttribute() {return $this->user->name;}
	public function getProductsDisplayAttribute()
	{
		$products = [];
		foreach ($this->order_items()->get() as $_item) {
			$products[] = $_item->quantity.'x '.$_item->product_description;
		}
		return implode ('<br>', $products);
	}
	public function getPaymentMethodDisplayAttribute() {
		$payment = $this->payment;
		if ($payment)
			return $payment->payment_method->title;
		else
			return '';
	}


}
