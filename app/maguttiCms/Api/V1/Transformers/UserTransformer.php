<?php namespace App\MaguttiCms\Api\V1\Transformers;

use App\User;
use League\Fractal;


class UserTransformer extends Fractal\TransformerAbstract
{
    public function transform(User $user)
    {
        return [
            'id'            => (int) $user->id,
            'first_name'    => $user->first_name,
            'last_name'     => $user->last_name,
            'email'         => $user->email,
            'lang'          => $user->lang,
            'country_code'  => $user->country_code,
            'unit'          => $user->unit,
            'gender'        => $user->gender,
            'jwt'           => $user->jwt,
            'download'      => (int)  $user->podcasts()->count(),// conta   quanti  podcast a scaricato l'utentegit
            'expire_date'   => $user->expire_date,
            //'created_at'    => $user->created_at,
            'updated_at'    => $user->updated_at,
        ];
    }
}