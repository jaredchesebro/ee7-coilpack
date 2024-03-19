<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ExpressionEngine Config Items
// Find more configs and overrides at
// https://docs.expressionengine.com/latest/general/system-configuration-overrides.html

$environment = env('APP_ENV') ?: 'production';

$config['app_version'] = '7.4.4';
$config['site_license_key'] = env('EE_SITE_LICENSE_KEY');
$config['encryption_key'] = env('EE_ENCRYPTION_KEY');
$config['session_crypt_key'] = env('EE_SESSION_CRYPT_KEY');
$config['show_ee_news'] = 'n';

$config['base_url'] = env('APP_URL');
$config['site_url'] = $config['base_url'];
$config['index_page'] = '';
$config['site_index'] = '';

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
$config['gmail_duplication_prevention'] = 'y';
$config['gzip_output'] = 'y';

$config['enable_devlog_alerts'] = 'y';
$config['debug'] = env('EE_DEBUG');
$config['show_profiler'] = env('EE_SHOW_PROFILER');

$config['cookie_domain'] = env('EE_COOKIE_DOMAIN');
$config['cookie_prefix'] = env('EE_COOKIE_PREFIX');
$config['cookie_secure'] = env('EE_COOKIE_SECURE');
$config['cookie_samesite'] = env('EE_COOKIE_SAMESITE');

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
		$config['log_threshold'] = '5';
		$config['cache_driver'] = 'file';
	break;
	
	// PRODUCTION ENV
	case 'production':
	case 'prod':
	default:
		$config['log_threshold'] = '1';
		$config['cache_driver'] = 'file';
		$config['cache_driver_backup'] = 'dummy';
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
		break;
		
}

// EOF