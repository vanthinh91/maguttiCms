<?php


namespace App\maguttiCms\Domain\Store\Discounts;

use App\maguttiCms\Definition\Definition;
use Carbon\Carbon;

trait DiscountPresenter
{

    /*
	|--------------------------------------------------------------------------
	|  DATE ATTRIBUTE
	|--------------------------------------------------------------------------
	*/
    public function setDateStartAttribute($value)
    {
        if ($value) {
            $this->attributes['date_start'] = Carbon::parse($value);
        }
    }

    public function getDateStartAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('d-m-Y');
        }
    }

    public function getFormattedDateStart()
    {
        return Carbon::parse($this->attributes['date_start'])->format('d-m-Y');
    }

    public function setDateEndAttribute($value)
    {
        if ($value) {
            $this->attributes['date_end'] = Carbon::parse($value);
        }
    }

    public function getDateEndAttribute($value)
    {
        if ($value) {
            return Carbon::parse($value)->format('d-m-Y');
        }
    }

    public function getFormattedDateEnd()
    {
        return Carbon::parse($this->attributes['date_end'])->format('d-m-Y');
    }


    /*
	|--------------------------------------------------------------------------
	|  AMOUNT
	|--------------------------------------------------------------------------
	*/

    function getLabelAttribute()
    {
        return $this->amount.''.$this->getSign();
    }

    function getSign()
    {
        return ($this->type==self::AMOUNT)?'€': '%';
    }
}