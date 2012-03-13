<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'default' => array
	(
		'root'			=> DOCROOT,
		'dir'			=> DOCROOT.'assets/cache',
		'gc'			=> TRUE,
		'filemtime'		=> TRUE,
		'compressor'	=> 'yui',
	),
	'javascripts' => array
	(
		'root'			=> DOCROOT,
		'dir'			=> DOCROOT.'assets/js/cache',
		'gc'			=> TRUE,
		'filemtime'		=> TRUE,
		'compressor'	=> 'closure_application',
	),
	'stylesheets' => array
	(
		'root'			=> DOCROOT,
		'dir'			=> DOCROOT.'assets/css',
		'gc'			=> TRUE,
		'filemtime'		=> TRUE,
		'compressor'	=> 'cssmin',
	),
);
