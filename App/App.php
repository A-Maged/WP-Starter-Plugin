<?php


namespace App;

class App
{
    public function __construct()
    {
        /* include js & css */
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts_styles']);

        /* Register Shortcode */
        // new Shortcode([
        //     'post_type' => "post", 'show_custom_column' => true
        // ]);
    }

    public function enqueue_scripts_styles()
    {
        wp_enqueue_style('plugin-styles', BASE_PLUGIN_URL . 'build/style.css');
        wp_enqueue_script('plugin-js', BASE_PLUGIN_URL . 'build/index.js', ['jquery'], false, true);
    }
}
