<?php namespace App\maguttiCms\Tools;

use App\Setting;

/**
* Class Setting
* @package App\maguttiCms\Tools
*/
class HtmlHelper {
	protected $args = [];

	public function setHtmlTagAttributes($array) {
		foreach($array as $key => $value) {
			$this->args[$key] = $value;
		}
		return $this;
	}

	public function getHtmlTagAttributes() {
		return $this->args;
	}

	public function createHtmlTagAttributes() {
		$attribute_string = "";

		foreach($this->getHtmlTagAttributes() as $key => $value) {
			$attribute_string .= $key ."=\"" . $value . "\" ";
		}

		return $attribute_string;
	}

	/**
	* @param $icons
	* @param $classes
	* @param $forceicon
	* @param $echo
	* @return mixed
	*/
	public static function createFAIcon($icons, $classes = '', $forceicon = false, $echo = true) {
		$arr_icons = explode(',', $icons);

		$str_classes = implode(' ',explode(',', $classes));

		if ((count($arr_icons) == 1) || ($forceicon !== false)) {
			$sel_icon = ($forceicon === false)? 0: $forceicon;
			//simple icon
			$output = '<i class="fa fa-'.$arr_icons[$sel_icon].' '.$str_classes.'"></i>';
		}
		else {
			//stacked icon
			$output = '';
			$output .= '<span class="fa-stack '.$str_classes.'">';
			$output .= '<i class="fa fa-'.$arr_icons[0].' fa-stack-2x"></i>';
			$output .= '<i class="fa fa-'.$arr_icons[1].' fa-stack-1x fa-inverse"></i>';
			$output .= '</span>';
		}

		if ($echo) echo $output; else return $output;
	}

	public static function checkError($errors, $field) {
		if ($errors->has($field)) {
			return 'input-danger';
		}
	}

	public static function videoEmbed($id, $ratio = '16by9') {
		$output = '';
		$output .= '<div class="embed-responsive embed-responsive-'.$ratio.'">';
		$output .= '<iframe class="embed-responsive-item" src="'.$id.'"></iframe>';
		$output .= '</div>';
		return $output;
	}

	// Get responsive image
	public function get_responsive($src, $args_small=['w' => 768], $args_medium=['w' => 1200]) {
		return "<picture>
		<source media='(max-width: 768px)' sizes='100vw'
		srcset='". \ImgHelper::get_cached($src, $args_small) ."'>
		<source media='(max-width: 1200px)' sizes='100vw'
		srcset='". \ImgHelper::get_cached($src, $args_medium) ."'>
		<img src='".ma_get_image_from_repository($src)."' ".$this->createHtmlTagAttributes().">
		</picture>";
	}
}
