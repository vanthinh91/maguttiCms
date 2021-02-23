<?php namespace App;

use App\maguttiCms\Builders\ArticleBuilder;
use App\maguttiCms\Builders\MaguttiCmsBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Translatable;

use \App\maguttiCms\Translatable\GFTranslatableHelperTrait;;

class PaymentMethod extends Model

{
    use HasFactory;
    use GFTranslatableHelperTrait;
    use Translatable;

    protected $with = ['translations'];

    protected $fillable = [
        'title',
        'description',
        'note',
        'code',
        'is_active',
        'sort'
    ];

    protected $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translatable
    |--------------------------------------------------------------------------
    */
    public $translatedAttributes = [
        'title',
        'description',
        'note'
    ];

    public $sluggable = [

    ];

    /*
    |--------------------------------------------------------------------------
    |  Builder & Repo
    |--------------------------------------------------------------------------
    */
    function newEloquentBuilder($query)
    {
        return new MaguttiCmsBuilder($query);
    }

    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */
    

    /*
    |--------------------------------------------------------------------------
    |  Fieldspec
    |--------------------------------------------------------------------------
    */
    function getFieldSpec()
    {
        $this->fieldspec['id'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 1,
            'label'    => trans('admin.label.id'),
            'hidden'   => 1,
            'display'  => 0,
        ];

        $this->fieldspec['code'] = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 0,
            'label'    => trans('admin.label.code'),
            'display'  => 1,
        ];

        $this->fieldspec['title'] = [
            'type'     => 'string',
            'required' => 1,
            'hidden'   => 0,
            'label'    => trans('admin.label.title'),
            'display'  => 1,
        ];

        $this->fieldspec['description'] = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'size'     => 600,
            'h'        => 300,
            'label'    => trans('admin.label.description'),
            'display'  => 1,
            'cssClass' => 'wyswyg',
        ];

        $this->fieldspec['note'] = [
            'type'     => 'text',
            'required' => 0,
            'hidden'   => 0,
            'size'     => 600,
            'h'        => 300,
            'label'    => trans('admin.label.note'),
            'display'  => 1,
            'cssClass' => 'wyswyg',
        ];



        $this->fieldspec['is_active'] = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.is_active'),
            'display'  => 1,
        ];

        $this->fieldspec['sort'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 1,
            'required' => 0,
            'label'    => trans('admin.label.sort'),
            'hidden'   => 0,
            'display'  => 1,
        ];

        return $this->fieldspec;
    }
}
