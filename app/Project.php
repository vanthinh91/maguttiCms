<?php namespace App;

use App\maguttiCms\Domain\Tag\Taggable;
use Illuminate\Database\Eloquent\Model;

use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

use App\maguttiCms\Domain\Media\Mediable;
use App\maguttiCms\Builders\ProductBuilder;
use App\maguttiCms\Domain\Project\ProjectPresenter;
use App\maguttiCms\Translatable\GFTranslatableHelperTrait;


class Project extends Model
{
    use Translatable;
    use GFTranslatableHelperTrait;

    use Mediable;
    use Taggable;
    use ProjectPresenter;

    protected $with = ['translations'];

    protected $fillable = ['category_id', 'title', 'subtitle', 'description', 'video', 'slug', 'sort', 'pub', 'permalink'];
    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Sluggable & Translateble
    |--------------------------------------------------------------------------
    */
    public array $translatedAttributes = ['title', 'slug', 'subtitle', 'description',
                                          'seo_title', 'seo_description', 'seo_no_index',
                                           'permalink'];

    public array $sluggable = ['slug' => ['field' => 'title', 'updatable' => false, 'translatable' => 1]];

    /*
    |--------------------------------------------------------------------------
    |  RELATION
    |--------------------------------------------------------------------------
    */

    public function category()
    {
        return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function getAllCategories()
    {
        return $this->hasMany('App\Category');
    }
    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */

    function getFieldSpec()
    {
        $this->fieldspec['id'] = [
            'type' => 'integer',
            'minvalue' => 0,
            'pkey' => 1,
            'required' => 1,
            'label' => 'id',
            'hidden' => 1,
            'display' => 0,
        ];
        $this->fieldspec['tag'] = [
            'type' => 'relation',
            'model' => 'Tag',
            'relation_name' => 'tags',
            'foreign_key' => 'id',
            'label_key' => 'title',
            'label' => 'Tags',
            'required' => 1,
            'display' => 1,
            'hidden' => 0,
            'multiple' => 1
        ];
        $this->fieldspec['category_id'] = [
            'type' => 'relation',
            'model' => 'Category',
            'foreign_key' => 'id',
            'label_key' => 'title',
            'label' => trans('admin.label.category'),
            'hidden' => 0,
            'required' => 1,
            'display' => 1,
        ];

        $this->fieldspec['title'] = [
            'type' => 'string',
            'required' => 1,
            'hidden' => 0,
            'label' => trans('admin.label.title'),
            'display' => 1,
        ];
        $this->fieldspec['slug'] = [
            'type' => 'string',
            'required' => 0,
            'hidden' => 0,
            'label' => trans('admin.label.slug'),
            'display' => 1,
        ];

        $this->fieldspec['subtitle'] = [
            'type' => 'string',
            'required' => false,
            'hidden' => 0,
            'label' => trans('admin.label.subtitle'),
            'display' => 1,
        ];
        $this->fieldspec['description'] = [
            'type' => 'text',
            'size' => 600,
            'h' => 300,
            'required' => false,
            'hidden' => 0,
            'label' => trans('admin.label.description'),
            'cssClass' => 'wyswyg',
            'display' => 1,
        ];
        $this->fieldspec['image'] = [
            'type' => 'media',
            'required' => false,
            'hidden' => 0,
            'label' => trans('admin.label.image'),
            'mediaType' => 'Img',
            'display' => 1
        ];
        $this->fieldspec['permalink'] = [
            'type' => 'string',
            'required' => 0,
            'hidden' => 0,
            'label' => trans('admin.label.permalink'),
            'display' => 1,
        ];
        $this->fieldspec['video'] = [
            'type' => 'string',
            'required' => 0,
            'hidden' => 0,
            'label' => "YouTube video code",
            'display' => 1,
        ];
        $this->fieldspec['doc'] = [
            'type' => 'media',
            'required' => false,
            'hidden' => 0,
            'label' => trans('admin.label.doc'),
            'mediaType' => 'Doc',
            'display' => 1
        ];
        $this->fieldspec['video'] = [
            'type' => 'string',
            'required' => false,
            'hidden' => 0,
            'label' => trans('admin.label.video'),
            'lang' => 0,
            'display' => 1,
        ];
        $this->fieldspec['sort'] = [
            'type' => 'integer',
            'required' => false,
            'label' => trans('admin.label.sort'),
            'hidden' => 0,
            'display' => 1,
        ];
        $this->fieldspec['pub'] = [
            'type' => 'boolean',
            'required' => false,
            'hidden' => 0,
            'label' => trans('admin.label.publish'),
            'display' => 1
        ];
        $this->fieldspec['seo_title'] = [
            'type' => 'string',
            'required' => 'n',
            'hidden' => 0,
            'label' => trans('admin.seo.title'),
            'display' => 1,
        ];
        $this->fieldspec['seo_description'] = [
            'type' => 'text',
            'size' => 600,
            'h' => 300,
            'hidden' => 0,
            'label' => trans('admin.seo.description'),
            'cssClass' => 'no',
            'display' => 1,
        ];
        $this->fieldspec['seo_no_index'] = [
            'type' => 'boolean',
            'required' => false,
            'hidden' => 0,
            'label' => trans('admin.seo.no-index'),
            'display' => 1
        ];
        return $this->fieldspec;
    }

}
