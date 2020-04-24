<?php

/**
 * Plugin Name: Custom Plugin
 * Description: My Custom Code
 */

defined('ABSPATH') or die();

/* load plugin last */
add_action('plugins_loaded', function () {

    /* check if "some class" you depend on is active */
    // if (!class_exists('OxyEl'))  return;

    /* load plugin */
    require_once __DIR__ . '/plugin.php';
});
