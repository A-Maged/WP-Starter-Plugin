<?php

namespace App;

class Shortcode
{
    public $tag = "my_custom_shortcode";
    public $post_type = "post";
    public $show_custom_column = false;

    public function __construct($args = array(
        'tag' => null,
        'post_type' => null,
        "show_custom_column" => false
    ))
    {
        if ($args['tag']) {
            $this->tag = $args['tag'];
        }
        
        if ($args['post_type']) {
            $this->post_type = $args['post_type'];
        }


        /* Adds shortcode tag */
        add_shortcode($this->tag, [$this, 'add_shortcode']);

                
        if ($args['show_custom_column']) {
            /* Add custom columns to $post_type */
            add_filter("manage_" . $this->post_type . "_posts_columns", [$this, 'add_column_titles']);
            
            /* Add data in custom columns of $post_type */
            add_action("manage_" . $this->post_type . "_posts_custom_column", [$this, 'add_column_data'], 10, 2);
        }
    }

    public function add_shortcode($atts)
    {
        return get_the_content("", false, $atts['id']);
    }

    public function add_column_titles($columns)
    {
        $columns['shortcode'] = __('Shortcode');

        return $columns;
    }

    public function add_column_data($column, $post_id)
    {
        switch ($column) {
            case 'shortcode':
                $title= get_the_title($post_id);
                echo "[$this->tag id='$post_id' title='$title']";
            break;
        }
    }
}
