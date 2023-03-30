<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// ExpressionEngine Config Items
// Find more configs and overrides at
// https://docs.expressionengine.com/latest/general/system-configuration-overrides.html

$environment = env('APP_ENV') ?: 'production';
$docroot = $_SERVER['DOCUMENT_ROOT'];

$config['app_version'] = '7.2.12';
$config['site_license_key'] = env('EE_SITE_LICENSE_KEY');
$config['encryption_key'] = env('EE_ENCRYPTION_KEY');
$config['session_crypt_key'] = env('EE_SESSION_CRYPT_KEY');
$config['show_ee_news'] = 'n';

$config['base_url'] = env('APP_URL');
$config['site_url'] = $config['base_url'];

$config['cp_url'] = $config['base_url'] . "/admin.php";
$config['base_path'] = $docroot . "/";
$config['index_page'] = '';
$config['site_index'] = '';
$config['theme_folder_path'] = $config['base_path'] . "themes/";
$config['theme_folder_url'] = $config['base_url'] . "/themes/";

$config['require_cookie_consent'] = 'n';
$config['cp_session_type'] = 'cs';
$config['allow_php'] = 'n';
$config['allow_dictionary_pw'] = 'n';
$config['name_of_dictionary_file'] = 'dictionary.txt';
$config['pw_min_len'] = '8';
$config['password_lockout'] = 'y';
$config['password_lockout_interval'] = '15';
$config['expire_session_on_browser_close'] = 'y';
$config['remove_unparsed_vars'] = 'n';
$config['debug'] = env('EE_DEBUG');

$config['cookie_domain'] = env('EE_COOKIE_DOMAIN');
$config['cookie_prefix'] = env('EE_COOKIE_PREFIX');
$config['cookie_secure'] = env('EE_COOKIE_SECURE');

$config['database'] = array(
	'expressionengine' => array(
		'hostname' => env('DB_HOST'),
		'database' => env('DB_DATABASE'),
		'username' => env('DB_USERNAME'),
		'password' => env('DB_PASSWORD'),
		'dbprefix' => 'exp_',
		'char_set' => 'utf8mb4',
		'dbcollat' => 'utf8mb4_unicode_ci',
		'port'     => env('DB_PORT'),
	),
);

//ENV SPECIFIC SETTINGS
switch ($environment) {

	// LOCAL DEV ENV
	case 'development':
	case 'dev':
	case 'local':
		$config['cookie_samesite'] = 'Lax';
		$config['enable_devlog_alerts'] = 'y';
		$config['log_threshold'] = '5';
		$config['show_profiler'] = 'y';
		$config['cache_driver'] = 'file';
		$config['gzip_output'] = 'y';
		$config['gmail_duplication_prevention'] = 'n';
	break;
	
	// STAGING ENV
	case 'staging':
	case 'stag':
		$config['cookie_samesite'] = 'Lax';
		$config['enable_devlog_alerts'] = 'y';
		$config['log_threshold'] = '5';
		$config['show_profiler'] = 'n';
		$config['cache_driver'] = 'file';
		$config['gzip_output'] = 'y';
		$config['gmail_duplication_prevention'] = 'y';
	break;
	
	// PRODUCTION ENV
	case 'production':
	case 'prod':
	default:
		$config['cookie_samesite'] = 'Strict';
		$config['enable_devlog_alerts'] = 'y';
		$config['log_threshold'] = '1';
		$config['show_profiler'] = 'n';
		$config['cache_driver'] = 'file';
		$config['cache_driver_backup'] = 'file';
		$config['redis'] = array(
			'host' => env('REDIS_HOST'),
			'password' => env('REDIS_PASSWORD'),
			'port' => env('REDIS_PORT'),
			'timeout' => 0
		);
		$config['memcached'] = array(
			array(
				'host' => env('MEMCACHED_HOST'),
				'port' => env('MEMCACHED_PORT'),
				'weight' => 1,
			)
		);
		$config['gzip_output'] = 'y';
		$config['gmail_duplication_prevention'] = 'y';
	break;
		
}

// EOF