<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

use App\maguttiCms\Domain\Newsletter\NewsletterPresenter;

class Newsletter extends Model
{

    use NewsletterPresenter;

    protected $fillable = ['locale', 'name', 'email', 'coupon_code', 'sort', 'pub'];
    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */

    public function coupon_code()
    {
        return $this->belongsTo('App\Discount', 'coupon_code', 'code');
    }

    function getFieldSpec(): array
    {
        return $this->fieldspec;
    }
}
