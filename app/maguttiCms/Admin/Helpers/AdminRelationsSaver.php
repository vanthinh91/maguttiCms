<?php namespace App\maguttiCms\Admin\Helpers;

use Illuminate\Support\Str;

/**
 *
 * Class AdminUserHelperTrait
 * @package App\maguttiCms\Admin\Helpers
 */
trait AdminRelationsSaverTrait
{
	public static function bootAdminRelationsSaverTrait()
	{
	}

	public function relationsSaver($model)
	{
		foreach ($this->getMultipleRelation() as $key => $value) {
			$value = collect($value);
			$method = $this->getRelationSaveMethod($key, $value);
			if (method_exists($model, $method)) {
				if (!$value->has('roles') || auth_user('admin')->hasRole($value->get('roles'))) {
					$model->{$method}($this->request->get($key));
				}
			}
		};
	}

	public function getRelationSaveMethod($key, $value)
	{
		return  ($value->has('relationSaveMethod'))? $value->get('relationSaveMethod'): 'save'.ucfirst(Str::plural($key)) ;
	}

	public function getMultipleRelation()
	{
		return collect($this->fieldSpecs)->where('type', '=', 'relation')->where('multiple', 1)->all();
	}
}
