<?php namespace App\maguttiCms\Admin;

use Carbon\Carbon;
use Form;
use Str;
use App;
use App\Media;

use App\maguttiCms\Admin\Facades\AdminFormImageRelation;

/**
* Class AdminForm
*
* @package App\maguttiCms\Admin
*/
class AdminForm {
	protected $html;
	protected $property;
	protected $showSeo;

	public function get($model)
	{
		$this->showSeo = false;
		$this->initForm($model);
		echo $this->render();
	}

	public function getSeo($model)
	{
		$this->showSeo = true;
		$this->initForm($model);
		echo $this->render();
	}

	public function setProperty($property)
	{
		$this->property = $property;
		return $this;
	}

	public function render()
	{
		return $this->html;
	}

	/**
	* @return string
	*/
	public function cssRow()
	{
		return $this->cssRow = (isset($this->property['cssRow']))? $this->property['cssRow']: '';
	}

	public function headerLabelRow()
	{
		return $this->headerLabelRow = (isset($this->property['headerLabel']))? "<h3 class=\"ml10 mb20\">".$this->property['headerLabel']."</h3>" :'';
	}

	protected function initForm($model)
	{
		$this->html = "";
		$this->model = $model;
		foreach ($this->model->getFieldSpec() as $key => $property) {
            if (Str::startsWith($key, 'seo') == $this->showSeo)
				$this->formModelHandler($property, $key, $this->model->$key);
		}

		$this->initLanguages();
	}

	public function initLanguages()
	{
		if (isset($this->model->translatedAttributes) && count($this->model->translatedAttributes) > 0) {
			$this->model->fieldspec = $this->model->getFieldSpec();
			foreach (config('app.locales') as $locale => $value) {
				if (config('app.locale') != $locale) {
					$target = "language_box_" . Str::slug($value) . "_" . Str::random(160);
					$this->html .= $this->containerLanguage($locale, $value, $target);
					$this->html .= "<div class=\"collapse language_box\" id=\"" . $target . "\">";
					foreach ($this->model->translatedAttributes as $attribute) {
						$value = (isset($this->model->translate($locale)->$attribute)) ? $this->model->translate($locale)->$attribute : '';
						$this->property = $this->model->fieldspec[$attribute];
						if (Str::startsWith($attribute, 'seo') == $this->showSeo)
							$this->formModelHandler($this->model->fieldspec[$attribute], $attribute.'_'.$locale, $value);
					}
					$this->html .= "</div>";
				}
			}
		}
	}

	private function formModelHandler($property, $key, $value = '') {
		$this->property  = $property;
		$cssClass        = (isset($this->property['cssClass']))? $this->property['cssClass']: '';
		$cssClassElement = (isset($this->property['cssClassElement']))? $this->property['cssClassElement']: '';
		$isLangField     = isset($this->property['lang']) && $this->property['lang'];
		$intMin			 = (isset($this->property['min']))? $this->property['min']: '';
		$intMax			 = (isset($this->property['max']))? $this->property['max']: '';
		$intStep		 = (isset($this->property['step']))? $this->property['step']: '';
		$formElement     = '';

		/**
		* populate field default value
		* if the model is empty
		*/

		if (isset($this->property['default_value']) && empty($this->model->id)){
			$value = $this->property['default_value'];
		}

		$field_properties = ['class' => ' form-control '.$cssClass];
		if (data_get($this->property, 'required', false)) {

			//$field_properties['required'] = true;
		}

		if ($isLangField || $this->property['display'] != 1) {

		}
		elseif (isset($this->property['hidden']) && $this->property['hidden'] && $this->property['type'] != 'relation') {
			$formElement = Form::hidden($key, $value, $field_properties);
		}
		elseif ($this->property['type'] == 'string') {
			$formElement = Form::text($key, $value, $field_properties);
		}
		elseif ($this->property['type'] == 'readonly') {
			$field_properties['readonly'] = true;
			$formElement = Form::text($key, $value, $field_properties);
		}
		elseif ($this->property['type'] == 'date' || $this->property['type'] == 'date-readonly') {
			$value = ($value) ? Carbon::parse($value)->format('d-m-Y') :date('d-m-Y');
			if ($this->property['type'] =='date-readonly') {
				$field_properties['readonly'] = true;
				Form::text($key, $value , $field_properties);
			} else {
				Form::text($key, $value , $field_properties);
			}
			$cssClassElement = (isset($this->property['cssClassElement']))? $this->property['cssClassElement']: 'col-md-2';
		}
		elseif ($this->property['type'] == 'integer' && $this->property['display'] == 1) {
			$cssClassElement = (isset($this->property['cssClassElement']))?$this->property['cssClassElement']:'col-md-2';
			$field_properties['min'] = $intMin;
			$field_properties['max'] = $intMax;
			$field_properties['step'] = $intStep;
			$formElement = Form::number($key, $value, $field_properties);
		}
		elseif ($this->property['type'] == 'color') {
			$formElement = '<div class="color-picker input-group colorpicker-component">';
			$formElement .= Form::text($key, $value, $field_properties);
			$formElement .= '<span class="input-group-addon"><i></i></span>';
			$formElement .= '</div>';
		}
		elseif ($this->property['type'] == 'text' && $this->property['display']== 1) {
			$h = (isset($this->property['h']))? $this->property['h']: 300;
			$field_properties['style'] = 'height:'.$h.'px';
			$formElement = Form::textarea($key, $value.'' , $field_properties);
		}
		elseif ($this->property['type'] == 'boolean' && $this->property['display']== 1) {
			$modelName = strtolower(class_basename($this->model));
			$booleanInputId = $key .'_'. $modelName .'_'. $this->model->id;

			//$formElement = Form::checkbox($key, 1 , $this->model->$key);
			$activeNo = ($value != '1')? ' active': '';
			$activeYes = ($value == '1')? 'active': '';
			$formElement.="<div class=\"btn-group\" data-toggle=\"buttons\">\n";
			$formElement.=' <button type="button" class="btn btn-default '.$activeYes.'" onclick="$(\'#'.$booleanInputId.'\').val(1)">
					<input type="radio" name="options" autocomplete="off" '.$activeYes.'>'.trans('admin.label.btn_yes').'
				</button>';
			$formElement.=' <button type="button" class="btn btn-default '.$activeNo.'" onclick="$(\'#'.$booleanInputId.'\').val(0)">
					<input type="radio" name="options" autocomplete="off" '.$activeNo.'> '.trans('admin.label.btn_no').'
				</button>';
			$formElement.="</div>\n";
			$formElement .= Form::hidden($key, $value , array('id'=> $booleanInputId,'class' => ' form-control '.$cssClass));

		}
		elseif ($this->property['type'] == 'locale' && $this->property['display']) {
			$formElement = view('admin.inputs.locale', ['properties' => $this->property, 'key' => $key, 'value' => $value]);
		}
		elseif ($this->property['type'] =='media' && $this->property['display']) {
			if (isset($this->property['cropper'])) {
				$formElement = view('admin.inputs.cropper', ['properties' => $this->property, 'key' => $key, 'cropperConfig' => collect($this->property['cropper'])]);
			} else {
				$formElement = view('admin.inputs.file', ['properties' => $this->property, 'key' => $key]);
			}
		}
		elseif ($this->property['type'] =='relation' && $this->property['display']) {
		    $selected = (isset($this->property['relation_name']) && $this->property['relation_name']!='') ? $this->model->{$this->property['relation_name']}->pluck('id')->toArray():'';
            $objRelation = $this->getRelation( $selected );
			$formElement = $this->getComboRelation($objRelation,$key,$value,$selected);
		}
		elseif ($this->property['type'] =='relation_set' && $this->property['display']) {
		    $selected = ($value!='')?explode(',',$value):'';
            $objRelation = $this->getRelation( $selected );
            $formElement   = $this->getComboRelation( $objRelation,$key,$value,$selected);
        }
		elseif ($this->property['type'] =='relation_tree' && $this->property['display']) {
		    $selected = (isset($this->property['relation_name']) && $this->property['relation_name']!='') ? $this->model->{$this->property['relation_name']}->pluck('id')->toArray():'';
            $objRelation = $this->getRelation();
			$objRelation = (new AdminTree)->setProperty($this->property)->getTreeRelation($objRelation,0);
			$formElement = $this->getComboRelation($objRelation, $key, $value, $selected);
		}
		elseif ($this->property['type'] =='relationimage' && $this->property['display']) {
		    $selected = (isset($this->property['relation_name']) && $this->property['relation_name']!='') ? $this->model->{$this->property['relation_name']}->pluck('id')->toArray():'';
            $objRelation = $this->getRelation();
			$formElement .= AdminFormImageRelation::setProperty($this->property)->getThumbRelation($objRelation, $key, $value, $selected);
		}
		elseif ($this->property['type'] == 'select' && $this->property['display'] && is_array($this->property['select_data'])) {
			$formElement = AdminFormSelect::withOptions($this->property['select_data'])->withName($key)->withSelected($value ?: '')->render();
		}
		else if($this->property['type'] =='map'  && $this->property['display']== 1) {
			$formElement  .= view('admin.inputs.map', ['properties' => $this->property, 'key' => $key, 'model' => $this->model]);;
		}

		if ($formElement && $this->property['type'] =='media'){
			if (isset($this->property['uploadifive']) && $this->property['uploadifive']) {
				$this->html .= $this->containerUploadifive($formElement, $cssClassElement, $key, $value);
			}
			elseif (isset($this->property['filemanager']) && $this->property['filemanager']) {
                $media = Media::where('id', $value)->first();
                $this->html .= view('admin.inputs.container_manager', ['properties' => $this->property, 'css_class' => $cssClassElement, 'key' => $key, 'model' => $this->model, 'value' => $value, 'media' => $media]);
			}
			else {
				$this->html .= $this->containerMedia($formElement, $cssClassElement, $key);
			}
		}
		elseif ($formElement)
			$this->html .= $this->container($formElement, $cssClassElement);
	}

    /**
     * @param $formElement
     * @param string $cssClass
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
	function container($formElement, $cssClass = '') {
		// GF_ma gestione campo hidden
		if (isset($this->property['hidden']) && $this->property['hidden'])
			$html = $formElement;
		else
			$html = view('admin.inputs.container', ['properties' => $this->property, 'form_element' => $formElement, 'css_class' => $cssClass]);
		return $html;
	}

	function containerMedia($formElement, $cssClass = "", $key) {
		return view('admin.inputs.container_media', ['properties' => $this->property, 'form_element' => $formElement, 'css_class' => $cssClass, 'key' => $key, 'model' => $this->model]);
	}

	public function containerUploadifive($formElement, $cssClass = "", $key, $value) {
		return view('admin.inputs.container_upload', ['properties' => $this->property, 'form_element' => $formElement, 'css_class' => $cssClass, 'key' => $key, 'model' => $this->model, 'value' => $value]);
	}

	public function containerFileManager($formElement, $cssClass = "", $key, $value, $media) {
	}

	function extraMsgHandler() {
		return (isset($this->property['extraMsg'])) ? $this->property['extraMsg'] :'';
	}

    /**
     * @param string $selected
     * @return mixed
     */
	public function getRelation( $selected = '' ) {
		$relationModel = "App\\".$this->property['model'] ;
		$model = new $relationModel;
		$orderField = (data_get($this->property,'order_field'))? $this->property['order_field']: $this->property['label_key'];
		$order = 'ASC';
		$query = $model::select(); //$relationModel;

		if (data_get($this->property,'orderRaw') && count($selected)) {
			$orderRaw = sprintf($this->property['orderRaw'], implode(', ', $selected));
		} else {
			$orderRaw = false;
		}

		if (isset($model->translatedAttributes) && in_array($this->property['label_key'],$model->translatedAttributes)) {
			return $this->getTranslatableRelation();
		} else {
			/** filter condition */
			if (isset($this->property['filter'])){
				foreach($this->property['filter'] as $column => $value)
				{
					$query->where($column, '=', $value);
				}
			}
			if (data_get($this->property,'whereRaw')){
				$query->whereRaw($this->property['whereRaw']);
			}
			if ($orderRaw) {

				$relationObj = $query->orderByRaw($orderRaw)->get();
			} else {
				$relationObj = $query->orderBy($orderField,$order)->get();
			}
			return $relationObj;
		}
	}

	/**
	* GET RELATION DATA FOR
	* TRANSLATABLE TABLE
	* CAN BE FILTERED
	* AND ORDERED
	* @return mixed
	*/
	function getTranslatableRelation(){
		$relationModel = "App\\".$this->property['model'] ;
		$orderField = (isset($this->property['order_field']))? $this->property['order_field']: $this->property['label_key'];
		$order = 'ASC';
		$table = with(new $relationModel)->getTable();
		$translationTable = strtolower(snake_case($this->property['model']));
		$a = (isset($this->property['foreign_key'])) ? $this->property['foreign_key'] : 'id';
		$query = $relationModel::join($translationTable.'_translations as t', 't.'.$translationTable.'_id', '=', $table.'.id')
			->where('locale', app()->getLocale())
			->groupBy($table.'.id')
			->with('translations');

		if ($a!='id') $query->select($table.'.'.$a, $table.'.id', 't.'.$this->property['label_key'].' as '.$this->property['label_key']);
		else $query->select($table.'.id', 't.'.$this->property['label_key'].' as '.$this->property['label_key']);

		if (data_get($this->property,'tree_field')) $query->addSelect($table.'.'.$this->property['tree_field']);
		if (data_get($this->property,'tree_field')) $query->addSelect($table.'.'.$orderField);

		if (isset($this->property['filter'])){
			foreach($this->property['filter'] as $column => $value)
			{
				$query->where($column, '=', $value);
			}
		}

		if (data_get($this->property,'whereRaw')){
			$query->whereRaw($this->property['whereRaw']);
		}

		$relationObj = $query->orderBy($orderField,$order)->get();
		return $relationObj ;
	}

	public function getComboRelation($obj, $field, $selItem = '', $selectedArray = '') {
		$a = (isset($this->property['foreign_key'])) ? $this->property['foreign_key'] : 'id';
		$b = (isset($this->property['label_key'] ) ) ? $this->property['label_key'] : 'name';
		$isRequired = (isset($this->property['required'] ) ) ? $this->property['required'] : false;
		$nullLabel = (isset($this->property['nullLabel'] ) ) ? $this->property['nullLabel'] : 'Select '.$this->property['label'];
		$multiple = (isset($this->property['multiple'] ) ) ? 'multiple' : '';
		$cssClass = (isset($this->property['cssClass']))?$this->property['cssClass'] :' ';

		// GF_ma gestione campo hidden
		if (isset($this->property['hidden']) && $this->property['hidden']==1) {
			if ($multiple) $html ="<select class=\"form-control hidden\" id=\"".$field."\" name=\"".$field."[]\" ".$multiple." >\n";
			else $html ="<select class=\"form-control hidden\" id=\"".$field."\" name=\"".$field."\" >\n";
		}
		else
		if ($multiple)$html ="<select data-placeholder=\"Select an option\" class=\"form-control selectizemulti\" id=\"".$field."\" name=\"".$field."[]\" ".$multiple.">\n";
		else $html ="<select class=\"form-control ".$cssClass." \" id=\"".$field."\" name=\"".$field."\" >\n";

		if ($isRequired==false) $html .="<option value=\"\">".$nullLabel."</option>";

		foreach($obj as $item) {
			$selected = ($item->$a == $selItem || (is_array($selectedArray) && in_array($item->$a,$selectedArray))) ? 'selected':'';
			$html .="<option value=\"".$item->$a."\" ".$selected.">".$item->$b."</option>\n";
		}
		$html .="</select>\n";
		return $html ;
	}

	public function createMediaDeleteBtn($key,$id) {
		$html="<a href=\"#\" rel=\"tooltip\" class=\"color-3 ph5\"
		data-original-title=\"".trans('admin.message.delete_item')."\"
		onclick=\"window.Cms.deleteImages(this)\" id=\"delete-".$key."-".$id."\"><i class=\"fa fa-trash big\"></i></a>";

		return $html ;
	}

	/********************************* LANGUAGE SECTION HELPER ***************************/
	function containerLanguage($locale, $label, $target) {
		return view('admin.inputs.language_header', ['locale' => $locale, 'label' => $label, 'target' => $target]);
	}

	/**
	* This method is used to build a dropdown input for the search section of 'model list'.
	*
	* @param $key: The name of the input field.
	* @param $field: The array of specifications (from config/maguttiCms/admin/list.php)
	*
	* @return string: The generated html string.
	*/
	public function buildSearchableField($key, $field, $placeholder = '') {

		// Pull the model instance out of the ioc container.
		$model = getModelFromString($field['model']);

		// $value is the 'value' of <option>.
		$value = isset($field['value']) ? $field['value'] : 'id';
		$caption = $field['field'];
		$orderField = (isset($field['order_field']))? $field['order_field']: $caption;
		$order = (isset($field['order']))? $field['order']: 'ASC';
		$cssClass = (isset($field['cssClass']))? $field['cssClass']: ' ';

		// Fetch all model records.
		$obj = (new $model)->newQuery();
		$obj->orderby($orderField,$order);
		if (isset($field['where']))
		$records = $obj->whereRaw($field['where'])->get();
		else
		$records =$obj->get();

		$html = "<select class='form-control ".$cssClass." ' id='{$key}' name='{$key}'>";
		$html .= "<option value=\"\">".$placeholder."</option>\n";
		foreach ($records as $record) {
			$html .= "<option value='{$record->$value}'>{$record->$caption}</option>\n";
		}
		$html .= "</select>";

		return $html;
	}

	/**
	* This method is used to build a suggestable field (it uses select 2).
	*
	* @param $key: The name of the input field.
	* @param $field: The array of specifications (from config/maguttiCms/admin/list.php)
	*
	* @return string: The generated html string.
	*/
	public function buildSuggestableField($key, $field, $placeholder){
		// Set convenience variables.
		$value = isset($field['value']) ? $field['value'] : 'id';
		$caption = $field['caption'];
		$additionalWhereClause = isset($field['where']) ? $field['where'] : '';
		$searchFields = isset($field['searchFields']) ? $field['searchFields'] : '';
		return "<select class='form-control suggest-remote' id='{$key}' name='{$key}'
		data-model='{$field['model']}'
		data-value='$value'
		data-caption='$caption'
		data-fields='$searchFields'
		data-placeholder='$placeholder'
		data-where='{$additionalWhereClause}'></select>";
	}
}
