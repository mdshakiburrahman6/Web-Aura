<?php

// register custome post type
function webaura_portfolio(){
    register_post_type('portfolio', array('labels' => array(
                        'name' => 'Portfolio',
                        'singular_name' => 'Portfolios',
                        'add_new' => 'Add New Portfolio',
                        'add_new_item' => 'Add New Portfolio',
                        'edit_item' => 'Edit Portfolio',
                        'view_item' => 'View Portfolio',
                        'not_found' => 'No portfolio found! Please add new portfolio',
                    ),
        'menu_icon' => 'dashicons-welcome-view-site',
        'menu_position' => 5,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => true,
        'has_archive' => true,
        'hierarchical' => false,
        'show_ui' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'portfolio'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    ));
}
add_action('init', 'webaura_portfolio');