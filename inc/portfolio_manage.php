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
        'taxonomies' => array('category', 'post_tag'),
        'rewrite' => array('slug' => 'portfolio'),
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
    ));
}
add_action('init', 'webaura_portfolio');

// For Show in category page
function query_post_type($query){
    if((is_category() || is_tag()) && $query->is_main_query()){
        $post_type = get_query_var('post_type');
        if($post_type){
            $post_type =$post_type;
        }else{
            $post_type = array('post', 'portfolio');
            $query-> set('post_type', $post_type);
            return $query;
         }
    }
}
add_filter('pre_get_posts','query_post_type');

