<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\maguttiCms\Domain\Address\AddressPresenter;


class Address extends Model
{
	use AddressPresenter;
    protected $with = ['country'];

    protected $fillable = [
        'firstname',
        'lastname',
		'user_id',
		'street',
		'number',
		'zip_code',
		'city',
		'province',
		'country_id',
		'phone',
		'mobile',
		'email',
		'vat'
    ];
    protected array $fieldspec = [];

    public array $sluggable = [];

	public function user()
	{
		return $this->belongsTo('App\User');
	}

	public function country()
	{
		return $this->belongsTo('App\Country');
	}

    function getFieldSpec(): array
    {
        return $this->fieldspec;
    }

}
