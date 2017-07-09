<?php

use App\maguttiCms\Tools\HtmlHelper;

function icon($icons, $classes = '', $forceicon = false, $echo = true) {
	return Htmlhelper::createFAIcon($icons, $classes, $forceicon, $echo);
}
