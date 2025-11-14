<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ExpressionEngine Config Items
// Find more configs and overrides at
// https://docs.expressionengine.com/latest/general/system-configuration-overrides.html

$config = require __DIR__ . '/config.master.php';

$config['app_version'] = '7.5.17';
$config['site_license_key'] = env('EE_SITE_LICENSE_KEY');

$global = [
	'global:env' => env('APP_ENV'),
];
global $assign_to_config;
if (! isset($assign_to_config['global_vars'])) {
	$assign_to_config['global_vars'] = [];
}
$assign_to_config['global_vars'] = array_merge(
	$assign_to_config['global_vars'],
	$global
);
// EOF