<?php namespace App\maguttiCms\Api\V1\Controllers;


use App\maguttiCms\Domain\Media\Action\DeleteMediaAction;
use Illuminate\Support\Facades\Log;
use Url;
use Validator;
use Illuminate\Http\Request;

use App\maguttiCms\Tools\ErrorCodes;
use App\maguttiCms\Tools\JsonResponseTrait;

use App\Media;
use App\maguttiCms\Domain\Media\Resource\AdminMediaResource;


class AdminFileMangerController
{
    use JsonResponseTrait;

    /**
     * @var Request
     */
    private Request $request;

    /**
     * @param Request $request
     * @param null $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request, $id = null)
    {
        $this->request = $request;
        $object = Media::when($id, function ($query) use ($id) {
            $query->orderByRaw('IF(FIELD(id,' . $id . ')=0,1,0)');
        })
            ->when($request->get('collection'), function ($query) use ($request) {
                $query->where('collection_name', $request->get('collection'));
            })
            ->when($request->get('media_category_id'), function ($query) use ($request) {
                $query->where('media_category_id', $request->get('media_category_id'));
            })
            ->where('model_type', '')
            ->orderBy('id', 'DESC')
            ->get();
        $items = AdminMediaResource::collection($object);
        return $this->setData($items)->responseSuccess()->apiResponse();
    }

    /**
     * This method is used to fetch edit view
     */
    public function edit($id)
    {
        $media = Media::find($id);
        if ($media) {
            return view('admin.helper.filemanager-edit', ['media' => $media]);
        }
        return $this->responseNotFound(__('api.errors.item_not_found'), ErrorCodes::MediaNotFound)->apiResponse();

    }

    public function update($id, Request $request)
    {
        $article = Media::find($id);

        $this->request = $request;

        foreach ($article->getFillable() as $a) {
            $article->$a = $this->request->get($a);
        }

        $article->save();

        // translatable
        if (isset($article->translatedAttributes) && count($article->translatedAttributes) > 0) {
            foreach (config('app.locales') as $locale => $value) {
                foreach ($article->translatedAttributes as $attribute) {
                    // se è un attributo sluggabile;
                    if (isset($article->sluggable) && $this->attributeIsSluggable($attribute, $article->sluggable)) {
                        $attribute_to_slug = (config('app.locale') != $locale) ? $attribute . '_' . $locale : $attribute;
                        $string_value = $this->setSlugAttributes($a)
                            ->sluggyTranslatable($article, $this->request->get($attribute_to_slug), $locale);

                        $article->translateOrNew($locale)->$attribute = $string_value;
                    } else {
                        if (config('app.locale') != $locale) {
                            $article->translateOrNew($locale)->$attribute = $this->request->get($attribute . '_' . $locale);
                        } else {
                            $article->translateOrNew($locale)->$attribute = $this->request->get($attribute);
                        }
                    }
                }
                $article->save();
            }
        }
        return $this->responseSuccess(__('api.messages.data_update'))->apiResponse();
    }


    function deleteMedia($id)
    {
        $media = Media::find($id);

        if ($media) {
            $response = (new DeleteMediaAction($media))->execute();
            if($response){
                return $this->responseSuccess(__('admin.file_manager.deleted'))->apiResponse();
            }
        }
        return $this->responseNotFound(__('api.errors.item_not_found'),ErrorCodes::MediaNotFound)
                     ->apiResponse();
    }
}