<?php

namespace App\maguttiCms\Website\Controllers\Store;

use Illuminate\Foundation\Http\FormRequest;
use Input;

class PaymentMethodFormRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_method_id' => 'required'
        ];
        return $rules;
    }
}


