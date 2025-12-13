<?php
/*---------------------------------------------------
  1. Register Portfolio Custom Post Type
---------------------------------------------------*/
function register_portfolio_post_type() {

    register_post_type('portfolio', array(
        'labels' => array(
            'name'          => 'Portfolio',
            'singular_name' => 'Portfolio Item',
        ),
        'public'        => true,
        'has_archive'   => true,
        'menu_icon'     => 'dashicons-portfolio',
        'supports'      => array('title', 'thumbnail'),
        'show_in_rest'  => true,
    ));

}
add_action('init', 'register_portfolio_post_type');


/*---------------------------------------------------
  2. Add Meta Box for Multiple Editors
---------------------------------------------------*/
function portfolio_add_editors_meta_box() {

    add_meta_box(
        'portfolio_editors_box',
        'Portfolio Content',
        'portfolio_editors_callback',
        'portfolio',
        'normal',
        'high'
    );

}
add_action('add_meta_boxes', 'portfolio_add_editors_meta_box');


/*---------------------------------------------------
  3. Display Multiple Text Editors
---------------------------------------------------*/
function portfolio_editors_callback($post) {

    wp_nonce_field('portfolio_editors_nonce', 'portfolio_editors_nonce_field');

    $overview    = get_post_meta($post->ID, '_portfolio_overview', true);
    $details     = get_post_meta($post->ID, '_portfolio_details', true);
    $testimonial = get_post_meta($post->ID, '_portfolio_testimonial', true);
    ?>

    <p><strong>Project Overview</strong></p>
    <?php wp_editor($overview, 'portfolio_overview', array(
        'textarea_name' => 'portfolio_overview',
        'media_buttons' => true,
        'textarea_rows' => 6,
    )); ?>

    <br><p><strong>Project Details</strong></p>
    <?php wp_editor($details, 'portfolio_details', array(
        'textarea_name' => 'portfolio_details',
        'media_buttons' => true,
        'textarea_rows' => 8,
    )); ?>

    <br><p><strong>Client Testimonial</strong></p>
    <?php wp_editor($testimonial, 'portfolio_testimonial', array(
        'textarea_name' => 'portfolio_testimonial',
        'media_buttons' => false,
        'textarea_rows' => 5,
    )); ?>

    <?php
}


/*---------------------------------------------------
  4. Save Editor Data
---------------------------------------------------*/
function portfolio_save_editors($post_id) {

    if (!isset($_POST['portfolio_editors_nonce_field']) ||
        !wp_verify_nonce($_POST['portfolio_editors_nonce_field'], 'portfolio_editors_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = array(
        'portfolio_overview'    => '_portfolio_overview',
        'portfolio_details'     => '_portfolio_details',
        'portfolio_testimonial' => '_portfolio_testimonial',
    );

    foreach ($fields as $field => $meta_key) {
        if (isset($_POST[$field])) {
            update_post_meta(
                $post_id,
                $meta_key,
                wp_kses_post($_POST[$field])
            );
        }
    }
}
add_action('save_post', 'portfolio_save_editors');