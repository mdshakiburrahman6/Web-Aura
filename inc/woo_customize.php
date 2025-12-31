<?php

 // 1. Add Meta Box || Register meta box
function webaura_woo_add_meta(){
    add_meta_box(
        'custom_product_meta',
        'Extra Information',
        'webaura_woo_meta_callbacK',
        'product',
        'normal',
        'default',
    );
}
add_action('add_meta_boxes', 'webaura_woo_add_meta');

// 2. Callback Function
function webaura_woo_meta_callbacK($post){

    wp_nonce_field('webaura_woo_nonce' , 'webaura_woo_nonce_field');

    $btn_url = get_post_meta($post->ID, '_btn_url', true);

    ?>
        <div style="width: 100%;">
            <label for="btn_url">Button Link</label>
            <input style="width: 100%;" value="<?php echo esc_attr($btn_url) ?>" type="text" name="btn_url" id="btn_url">
        </div>
    <?php
}

// 3. Save Post Meta
function webaura_woo_meta_save($post_id){

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(!isset($_POST['btn_url']) || !wp_verify_nonce($_POST['webaura_woo_nonce_field'],'webaura_woo_nonce')) return;
    if(!current_user_can('edit_product', $post_id)) return;

    if(isset($_POST['btn_url'])){
        update_post_meta($post_id, '_btn_url', sanitize_text_field( $_POST['btn_url'] ));
    }

}
add_action('save_post', 'webaura_woo_meta_save');



// 4. Display in Frontend
function webaura_woo_meta_show(){

    global $post;

    $btn_url = get_post_meta($post->ID, '_btn_url', true);

    if(!empty($btn_url)){
        echo '<a style="background-color:red; color: white;" href="'.esc_url($btn_url).'" class="button">Visit Link</a>';
    }

}
add_action('woocommerce_single_product_summary','webaura_woo_meta_show', 31);