<?php

/**
 * Plugin Name: Custom Plugin
 * Description: My Custom Code
 */

defined('ABSPATH') or die();

/* load plugin last */
add_action('plugins_loaded', function () {
    /* load plugin */
    require_once __DIR__ . '/plugin.php';
});
