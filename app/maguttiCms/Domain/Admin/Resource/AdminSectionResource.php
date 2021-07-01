<?php


namespace App\maguttiCms\Domain\Admin\Resource;

use App\maguttiCms\Website\Facades\ImgHelper;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminSectionResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => (string)$this->value,
            'title' => (string)$this->title,
        ];
    }
}