<?php namespace App\maguttiCms\Admin\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Input;

class AdminFormRequest extends FormRequest
{
	/**
	* Determine if the user is authorized
	* to make this request.
	*
	* @return bool
	*/
	public function authorize()
	{
		return true;
	}

	/**
	* Get the validation rules that
	* apply to the request.
	*
	* @return array
	*/
	public function rules()
	{
		$model = ($this::segment(2)=='create')? $this::segment(count($this::segments())): $this::segment(count($this::segments())-1);

		//Metodo Standard sarà rimosso
		$rules = config('maguttiCms.admin.form_validation.'.$model);

		$curModel = getModelFromString(config('maguttiCms.admin.list.section.'.$model)['model']);
		$obj = new $curModel;

		foreach($obj->getFieldspec() as $key => $field) {
			if (data_get($field,'validation') != '') {
				$rules[$key] = $field['validation'];
			} else if (data_get($field, 'required') && in_array($key, $obj->getFillable())) {
				$rules[$key] = "required";
			}
		};
		return $rules;
	}
}
