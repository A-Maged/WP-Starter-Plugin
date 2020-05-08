<?php

define('BASE_PLUGIN_URL', plugin_dir_url(__FILE__));
define('BASE_PLUGIN_PATH', plugin_dir_path(__FILE__));
// define('SENDGRID_PASSWORD', '');

/* Autoload */
require_once __DIR__ . '/vendor/autoload.php';

/* Includes */
require_once __DIR__ . '/includes/helpers.php';
require_once __DIR__ . '/includes/custom-post-types.php';

/* Main plugin file */
$app = new App\App();
