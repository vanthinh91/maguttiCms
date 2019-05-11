<?php namespace App\maguttiCms\Admin;
use Form;
use App;

/**
 * Class AdminTree
 * @package App\maguttiCms\Admin
 */
class AdminCheckBox extends AdminFormComponent {

    protected  $active = "active";

    public function getCheckBox($value,$key) {

        $this->modelName = strtolower(class_basename($this->formObject->model));
        $booleanInputId = $key .'_'. $this->modelName .'_'. $this->formObject->model->id;
        //$formElement = Form::checkbox($key, 1 , $this->model->$key);
        $activeNo = ($value != '1')? ' '.$this->active: '';
        $activeYes = ($value == '1')? $this->active: '';
        $this->html.="<div class=\"btn-group\" data-toggle=\"buttons\">\n";
        $this->html.=' <button type="button" class="btn btn-default '.$activeYes.'" onclick="$(\'#'.$booleanInputId.'\').val(1)">
					<input type="radio" name="options" autocomplete="off" '.$activeYes.'>'.trans('admin.label.btn_yes').'
				</button>';
        $this->html.=' <button type="button" class="btn btn-default '.$activeNo.'" onclick="$(\'#'.$booleanInputId.'\').val(0)">
					<input type="radio" name="options" autocomplete="off" '.$activeNo.'> '.trans('admin.label.btn_no').'
				</button>';
        $this->html.="</div>\n";
        /* GF_ma aggiornato dopo Aggiunta Middleware ConvertEmptyStringsToNull metto di default 0 anzichè null */
        $value = ($value === null) ? 0 : $value;
        $this->html .= Form::hidden($key, $value , array('id'=> $booleanInputId,'class' => ' form-control '.$this->formObject->cssClass));
        return    $this->html ;
    }

}
