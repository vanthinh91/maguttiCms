<?php namespace App;
use Illuminate\Database\Eloquent\Model;
use \App\maguttiCms\Translatable\GFTranslatableHelperTrait;

class Tag extends Model
{
    use \Dimsav\Translatable\Translatable;
    use GFTranslatableHelperTrait;

    public    $translatedAttributes = ['title'];
    public    $sluggable = ['slug'];
    protected $fillable  = ['title','slug'];
    protected $fieldspec = [];

    /*
     * Get news  associates with the tags
     * Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function news(){
        return $this->belongsToMany('App\News');
    }


    function getFieldSpec ()
    {

        $this->fieldspec['id'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 'y',
            'required' => true,
            'label'    => 'id',
            'hidden'   => 1,
            'display'  => 0,
        ];
        $this->fieldspec['title']   = [
            'type'      => 'string',
            'required'  => true,
            'hidden'    => 0,
            'label'     => 'Title',
            'extraMsg'  => '',
            'display'   => 1,
        ];
        $this->fieldspec['slug'] = [
            'type'      => 'string',
            'required'  => false,
            'hidden'    => 0,
            'label'     => 'Slug',
            'extraMsg'  => '',
            'display'   => 1,
        ];
        return $this->fieldspec;
    }

}
