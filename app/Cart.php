<?php namespace App;

use App\maguttiCms\Domain\Store\CartPresenter;
use Illuminate\Database\Eloquent\Model;

use \App\maguttiCms\Translatable\GFTranslatableHelperTrait;

class Cart extends Model
{

    use CartPresenter;

    protected $fillable = ['user_id', 'status', 'billing_address_id', 'shipping_address_id','discount_code'];
    protected $fieldspec = [];

    protected $appends = ['discount_amount','discount_type'];

    public $sluggable = [];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function discount()
    {
        return $this->belongsTo('App\Discount', 'discount_code', 'code');
    }


    public function cart_items()
    {
        return $this->hasMany('App\CartItem');
    }



    public function order()
    {
        return $this->hasOne('App\Order');
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
