<?php namespace App;

use App\maguttiCms\Domain\Store\CartPresenter;
use Illuminate\Database\Eloquent\Model;

use \App\maguttiCms\Translatable\GFTranslatableHelperTrait;

class Cart extends Model
{

    use CartPresenter;

    protected $fillable = ['user_id', 'status', 'payment_method_id', 'shipping_cost',
        'billing_address_id', 'shipping_address_id', 'discount_code'
    ];
    protected $fieldspec = [];

    protected $appends = ['discount_amount', 'discount_type'];

    public $sluggable = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function discount()
    {
        return $this->belongsTo('App\Discount', 'discount_code', 'code');
    }

    public function shipping_address()
    {
        return $this->belongsTo('App\Address', 'shipping_address_id', 'id');
    }

    public function billing_address()
    {
        return $this->belongsTo('App\Address', 'billing_address_id', 'id');
    }

    public function display_billing_address()
    {
        return ($this->billing_address_id!='') ? $this->billing_address():$this->shipping_address();

    }


    public function cart_items()
    {
        return $this->hasMany('App\CartItem');
    }

    public function payment_method()
    {
        return $this->belongsTo('App\PaymentMethod');
    }


    public function order()
    {
        return $this->hasOne('App\Order');

    }
    /*
    |--------------------------------------------------------------------------
    |  Action
    |--------------------------------------------------------------------------
    */

    function update_cart_address($address_field,$address_id){

        $this->update([$address_field => $address_id]);
    }

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec
    |--------------------------------------------------------------------------
    */
    function getFieldSpec()
    {
        return $this->fieldspec;
    }
}
