<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class SpecialPrice extends Model
{
    protected $fillable = [
		'product_code',
		'list_code',
		'price'
    ];
    protected array $fieldspec = [];

    public array $sluggable = [];

	public function product()
	{
		return $this->belongsTo('App\Product', 'product_code', 'code');
	}

    function getFieldSpec(): array
    {
        return $this->fieldspec;
    }
}
