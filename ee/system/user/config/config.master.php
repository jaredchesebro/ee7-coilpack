<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$base_url = rtrim(env('APP_URL'), '/') . '/';
$base_path = rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/';
$isDev = (str_contains(env('APP_ENV'), 'local') OR str_contains(env('APP_ENV'), 'dev')) ? 'y' : 'n';
$isProd = (str_contains(env('APP_ENV'), 'prod')) ? '0' : '1';
$preview_domain = (!empty($_SERVER['HTTP_HOST'])) ? $_SERVER['HTTP_HOST'] : '';

// ExpressionEngine Config Items
// Find more configs and overrides at
// https://docs.expressionengine.com/latest/general/system-configuration-overrides.html

return [

    // Tap, tap. Is this thing on?
    'is_system_on' => 'y',
    'is_system_on_before_updater' => 'y',
    'allow_extensions' => 'y',

    // Paths and urls
    'base_url' => $base_url,
    //'base_path' => $base_path,
    'site_url' => $base_url,
    'cp_url' => $base_url . 'admin.php',
    'site_index' => '',
    'index_page' => '',
    'allowed_preview_domains' => $preview_domain,
    //'theme_folder_url' => $base_url . 'themes/',
    //'theme_folder_path' => $base_path . 'themes/',
    'avatar_url' => $base_url . 'uploads/avatars/',
    'avatar_path' => $base_path . 'uploads/avatars/',
    'captcha_url' => $base_url . 'uploads/captchas/',
    'captcha_path' => $base_path . 'uploads/captchas/',
    'emoticon_url' => $base_url . 'images/smileys/',
    'sig_img_path' => $base_path . 'images/signature_attachments/',
    'sig_img_url' => $base_url . 'images/signature_attachments/',

    // Encryption Keys    
    'encryption_key' => env('EE_ENCRYPTION_KEY'),
    'session_crypt_key' => env('EE_SESSION_CRYPT_KEY'),

    // Database
    'database' => [
        'expressionengine' => [
            'hostname' => env('DB_HOST'),
		    'database' => env('DB_NAME'),
		    'username' => env('DB_USER'),
		    'password' => env('DB_PASS'),
            'dbprefix' => 'exp_',
            'char_set' => 'utf8mb4',
            'dbcollat' => 'utf8mb4_unicode_ci',  
            'port'     => env('DB_PORT'),
        ],
    ],

    // Debugging    
    'debug' => $isProd,
    'enable_devlog_alerts' => $isDev,
    'show_profiler' => $isDev,
    'log_threshold' => '0',
    'log_date_format' => 'Y-m-d H:i:s',

    // Cache
    'cache_driver' => env('CACHE_DRIVER'),
    'cache_driver_backup' => 'file',
    'redis' => [
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => 6379,
        'timeout' => 0
    ],
    /*'memcached' => [        
        'host' => '127.0.0.1',
        'port' => 11211,
        'weight' => 1,
    ],*/

    // Cookies
    'cookie_httponly' => 'y',
    'require_cookie_consent' => 'n',
    'website_session_type' => 'c',
    'cp_session_type' => 'cs',
    'cookie_domain' => env('EE_COOKIE_DOMAIN'),
    'cookie_prefix' => env('EE_COOKIE_PREFIX'),
    'cookie_secure' => env('EE_COOKIE_SECURE'),
    'cookie_samesite' => env('EE_COOKIE_SAMESITE'),

    // Security
    'cli_enabled' => $isDev,
    'gmail_duplication_prevention' => 'y',
    'allow_php' => 'n',
    'name_of_dictionary_file' => 'dictionary.txt',
    'require_secure_passwords' => 's',
    'new_version_check' => $isDev,
    'x_frame_options' => 'DENY',
    'profile_trigger' => uniqid('', true), // Hide member profiles on the front end
    'allow_dictionary_pw' => 'n',
    'pw_min_len' => '8',
    'password_lockout' => 'n',
    'password_lockout_interval' => '15',
    'expire_session_on_browser_close' => 'y',
    'remove_unparsed_vars' => 'n',

    // Misc
    'gzip_output' => 'y',
    'show_ee_news' => 'n',
    'share_analytics' => 'n',
    'legacy_member_templates' => 'n',
    'save_tmpl_revisions' => 'n',
    'strip_image_metadata' => 'y',

];
// EOF
