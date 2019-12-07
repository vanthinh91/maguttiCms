<?php

return [
    'repository'     => env('ASSET_PUBLIC_PATH','public/').'media/',
    'img_repository' => env('ASSET_PUBLIC_PATH','public/').'media/images/',
    'img_save'       => env('ASSET_PUBLIC_PATH','public/').'media/images/cache/',
    'doc_repository' => env('ASSET_PUBLIC_PATH','public/').'media/docs/',

    'media_img_repository' => env('ASSET_PUBLIC_PATH','public/').'media/images/',
    'media_doc_repository' => env('ASSET_PUBLIC_PATH','public/').'media/docs/',

	'cms'            => 'cms/',
	'cms_assets'     => 'cms/',
	'cms_js'         => 'cms/js/',
	'cms_css'        => 'cms/css/',

	'assets'     	 => '',
	'common_js'      => 'js/',
	'js_vendor'      => 'js/vendor/',
	'plugins'        => 'plugins/',
	'common_css'     => 'css/',
	'css_vendor'     => 'css/vendor/',

	'user_upload'    => 'upload/',

    'expor_data'     => 'export/',
    'shared'         => 'shared_data/',


];
