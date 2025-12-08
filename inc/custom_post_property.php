<?php

// Add Custome Post Type
function webaura_property(){
    register_post_type('property', array(
        'labels' => array(
                        'name' => __('All Property', 'webaura'),
                        'singular_name' => __('Property', 'webaura'),
                        'add_new' => __('Add New Property','webaura'),
                        'add_new_item' => __('Add New Property','webaura'),
                        'view_item' => __('View Property','webaura'),
                        'edit_item' => __('Edit Property','webaura'),
                        'new_item' => __('New Property','webaura'),
                        'not_found' => __('No property found!!! Please create a new porperty.','webaura'),
                    ),
        'menu_icon' => 'dashicons-align-wide',
        'menu_position' => 7,
        'public' => true,
        'publicly_queryable' => true,
        'exclude_form_search' => true,
        'has_archive' => true,
        'hierarchical' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'rewrite' => array('slug' => 'property'),
        'supports' => array('title', 'thumbnail', 'excerpt', 'editor'),
    ));
}
add_action('init', 'webaura_property');

// ===================== Meta Box =======================//

// Register Meta Boxs
function webaura_property_meta_box(){
    add_meta_box(
        'webaura_property_id',  // id
        'Property Price',  // Title
        'webaura_property_meta_box_field', // Callback Function
        'property',  // Post Type
        'normal',  // Position
        'high', // Priority
    );
}
add_action('add_meta_boxes','webaura_property_meta_box');


// Add Meta Box Field  --  input field
function webaura_property_meta_box_field($post){

    // Get Old Value
    $price = get_post_meta($post->ID, 'webaura_property_price', true);
    $phone = get_post_meta($post->ID, 'webaura_property_phone', true);
    $email = get_post_meta($post->ID, 'webaura_property_email', true);

    ?>
        <p>
            <label for="webaura_property_price">Price</label>
            <input style="width: 30%;" type="text" name="webaura_property_price" value="<?php echo esc_attr($price) ?>">
            <label for="webaura_property_phone">Phone</label>
            <input style="width: 30%;" type="tel" name="webaura_property_phone" value="<?php echo esc_attr($phone) ?>">
            <label for="webaura_property_email">Email</label>
            <input style="width: 30%;" type="email" name="webaura_property_email" value="<?php echo esc_attr($email) ?>">
        </p>
    <?php   
}

// Save Meta Box Data
function webaura_property_meta_box_data_save($post_id){
    if(array_key_exists('webaura_property_price', $_POST)){
        update_post_meta($post_id, 'webaura_property_price', sanitize_text_field( $_POST['webaura_property_price'] ));
    }
    if(array_key_exists('webaura_property_phone', $_POST)){
        update_post_meta($post_id, 'webaura_property_phone', sanitize_text_field( $_POST['webaura_property_phone'] ));
    }
     if(array_key_exists('webaura_property_email', $_POST)){
        update_post_meta($post_id, 'webaura_property_email', sanitize_text_field( $_POST['webaura_property_email'] ));
    }
}
add_action('save_post', 'webaura_property_meta_box_data_save');
