<?php
return [
		'adminusers' => [
			'first_name' => 'required',
			'last_name'  => 'required',
            'email' => 'required|Between:3,64|Email|is_unique',
			'role' => 'required',
			'password' => 'alpha_num|min:6|confirmed',
			'password_confirmation' => 'alpha_num|min:6',
		],

		'contacts' => [
			'name'	  => 'required',
			'company' => 'required',
			'subject' => 'required',
			'message' => 'required',
			'email'   => 'required|Between:3,64|Email',
		],
		'categories' => [
			'title' => 'required',
	    ],
		'countries' => [
			'name' => 'required',
			'iso_code' => 'required|Between:1,3',
		],
		'domains' => [
			'title'  => 'required',
			'domain' => 'required',
		],
		'media' => [
			'title' => 'required',
     	],
		'hpsliders' => [
			'title' => 'required',
		],

		'products' => [
			'title' => 'required',
		],
		'productmodels' => [
			'title' => 'required',
		],
		'paymentmethods' => [
			'title' => 'required',
			'code' => 'required',
		],
		'provinces' => [
			'title' => 'required',
			'code' => 'required',
		],

		'roles' => [
			'name' => 'required',
			'display_name' => 'required',
		],
		'socials' => [
			'title' => 'required',
			'link' => 'required',
			'icon' => 'required',
		],
		'settings' => [
			'value'  => 'required',
			'key' => 'required',
		],
		'states' => [
			'title' => 'required',
		],
		'users' => [
			'name' => 'required',
			'email' => 'required|Between:3,64|Email|is_unique',
		    'password' => 'alpha_num|min:6|confirmed',
			'password_confirmation' => 'alpha_num|min:6',
		],
		'examples' => [
			'title' => 'required',
		],
];
