<?php

// This themplate is for Question (FAQ) Custome_post_type 


// Register Custome Post Type
function webaura_question(){
    $labels = array(
            'name' => 'Questions',
            'singular_name' => 'Question',
            'add_item' => 'Add New Question',
            'add_new_item' => 'Add New Question',
            'new_item' => 'New Question',
            'view_item' => 'View Question',
            'edit_item' => 'Edit Question',
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-list-view',
        'menu_position' => 6,
        'public' => true,
        'publicly_queryable' => true,
        'hierarchical' => false,
        'show_ui' => true,
        'has_archive' => true,
        'exclude_from_search' => true,
        'capability_type' => 'post',
        'taxonomies' => array('category', 'post_tag'),
        'rewrite' => array('slug' => 'question'),
        'supports' => array('title', 'excerpt', 'thumbnail'),
    );
    register_post_type('questions', $args);
}
add_action('init', 'webaura_question');


/* ======================
Add Meta Box
========================= */

// Register Meta box
function webaura_question_meta_boxes(){
    add_meta_box(
        'questions_second_editor',     // id
        'Second Editor',    // Title
        'webaura_question_meta_fields',     // Callback
        'questions',    // Post Type
        'normal', // Position
        'low', // Priority
    );
}
add_action('add_meta_boxes', 'webaura_question_meta_boxes');

function webaura_question_meta_fields($post){

    
    wp_nonce_field( 'questions_second_editor_nonce', 'questions_second_editor' );
    
    $second_content = get_post_meta($post->ID, 'questions_detsils', true);

    ?>
        <!-- <p><strong>Question Details</strong></p> -->
        <?php wp_editor($second_content, 'questions_detsils', array(
            'textarea_name' => 'questions_detsils',
            'textarea_rows' => 7,
            'media_buttons' => true,
        ) ); ?>
    <?php
   
}

// Save Meta boxes

function webaura_question_meta_box_save($post_id){

    if(!isset($_POST['questions_second_editor'])){
        !wp_verify_nonce($_POST['questions_second_editor'], 'questions_second_editor_nonce');
        return;
    }

    if(defined('DOING_AUTOSAFE') && DOING_AUTOSAVE) {
        return;
    }

    if(!current_user_can('edit_post', $post_id)){
        return;
    }

    if(isset($_POST['questions_detsils'])){
        update_post_meta($post_id, 'questions_detsils', wp_kses_post( $_POST['questions_detsils'] ));
    }


}
add_action('save_post','webaura_question_meta_box_save');


