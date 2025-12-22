<?php

/*
Template Name: Repitor Manager
*/ 

// 1. Register Post Type
function webaura_repeator(){
    $labels = array(
        'name' => 'Repeator',
        'singular_name' => 'Repeator',
        'not_found' => 'No repeator found!'
    );
    $args = array(
        'labels' => $labels,
        'menu_icon' => 'dashicons-update',
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'repeator'),
        'supports' => array('title'),
    );

    register_post_type('repeator', $args);
}
add_action('init','webaura_repeator');



// 2. Add Meta Box
function webaura_repeator_meta_box(){
    add_meta_box(
        'repeator_id',
        'Repeator Items',
        'webaura_repeator_callback',
        'repeator',
        'normal',
        'high',
    );
}
add_action('add_meta_boxes', 'webaura_repeator_meta_box');



// 3. Meta Box Callback (Frontend UI)
function webaura_repeator_callback($post){

    // Needed Input Type =  [text, editor, checkbox, Radio, dropdown, image, image gallery]
    
    wp_nonce_field('webaura_repeator_nonce', 'webaura_repeator_nonce_field');

    $repeators = get_post_meta($post->ID, '_repeators', true);
    $repeators = is_array($repeators) ? $repeators : [];

    if(empty($repeators)){
        $repeators[] =  ['question' => '',
                        'type'  =>  'text',
                        'answer' => '',
                        'options' => [''],
                        'image'    => 0,
                        ];
    }

    ?>

        <div class="repeator-wrapper">
            <!-- Repeator Fields -->
            <?php 
                foreach($repeators as $index => $rep):
            ?>
                <div class="repeator-item">
                    <!-- Question -->
                    <input class="repeator-question" type="text" name="rpt[<?php echo $index; ?>][question]" value="<?php echo esc_attr( $rep['question'] ); ?>" placeholder="Enter your Question">

                    <!-- Type -->
                    <label for="repeator_type_label">Select a Type</label>
                    <select class="repeator-type" name="rpt[<?php echo $index; ?>][type]">
                        <option value="text" <?php selected($rep['type'],'text'); ?>>Text</option>
                        <option value="editor" <?php selected($rep['type'],'editor'); ?>>Editor</option>
                        <option value="radio" <?php selected($rep['type'],'radio'); ?>>Radio</option>
                        <option value="image" <?php selected($rep['type'],'image') ?>>Image</option>
                    </select>
                    
                    
                    <!-- Text (type) -->
                   <div class="rep-type-text">
                         <input class="repeator-answer-text" type="text" name="rpt[<?php echo $index; ?>][answer]" value="<?php echo esc_attr($rep['answer']); ?>" placeholder="Enter the Answer.">
                   </div>
                    

                    <!-- Editor -->
                    <div class="rep-type-editor">
                        <?php wp_editor($rep['answer'], 'rpt_editor_' . $index, array(
                            'textarea_name' => "rpt[$index][answer]",
                            'textarea_rows' => 8,
                            'media_buttons' => true,
                        )); ?>
                    </div>
                     
                    <!-- Radio (type)-->
                    <div class="repeator-answer-radio">
                        <?php foreach($rep['options'] as $opt) : ?>
                            <input class="repeator-answer-text" type="text" name="rpt[<?php echo $index; ?>][options][]" value="<?php echo esc_attr($opt); ?>" placeholder="Enter the Option.">
                        <?php endforeach; ?>
                        <div class="repeator-option-button">
                            <button type="button" id="add-rep-opt" class="button add-rep-opt">Add Options</button>
                        </div>
                    </div>

                    <!-- Image -->
                    <div class="repeator-type-image">
                        <input class="rep-image-id" type="hidden" name="rpt[<?php echo $index; ?>][image]" value="<?php echo esc_attr( $rep['image']); ?>">

                        <button class="button rep-image-upload" type="button">Select Image</button>
                            
                        <div class="rep-image-preview">
                            <?php   
                                if(!empty($rep['image'])) : 
                                    echo wp_get_attachment_image($rep['image'], 'thumbnail');
                                endif;    
                            ?>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>

            <!-- Repetor Button -->
            <div class="repeator-button">
                <button type="button" id="add-rep-question" class="button add-rep-question">Add Question</button>
            </div>
        </div>

    <?php

}



// 4. Save Meta
function webaura_repeator_save_meta($post_id){
    
    if(get_post_type($post_id) !== 'repeator') return;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if(! current_user_can('edit_post', $post_id)) return;

    if(!isset($_POST['webaura_repeator_nonce_field']) || ! wp_verify_nonce($_POST['webaura_repeator_nonce_field'],'webaura_repeator_nonce')) return;

    if(isset($_POST['rpt']) && is_array($_POST['rpt'])){
    
    

        $clean = [];

       foreach($_POST['rpt'] as $rep){

            $image = isset($rep['image']) ? intval($rep['image']) : 0;

            $clean[] = [
                'question' => sanitize_text_field($rep['question'] ?? ''),
                'type' => sanitize_text_field( $rep['type'] ?? 'text' ),
                'answer' => sanitize_text_field( $rep['answer'] ?? '' ),
                'options' => isset($rep['options']) ? array_map('sanitize_text_field', $rep['options'] ) : [],
                'image'    => $image,
            ];
       }
       update_post_meta($post_id, '_repeators', $clean);
    }

}
add_action('save_post','webaura_repeator_save_meta');


// =============================
// 5. Enqueue Admin Assets (Repeator)
// =============================
function webaura_repeator_admin_assets($hook) {

    global $post;

    // Only load on repeator post type edit screen
    if (
        ($hook === 'post.php' || $hook === 'post-new.php') &&
        isset($post) &&
        $post->post_type === 'repeator'
    ) {

        // Admin CSS (optional)
        wp_enqueue_style(
            'webaura-repeator-admin-css',
            get_template_directory_uri() . '/assets/css/repeator-admin.css',
            [],
            '1.0'
        );

        // Admin JS
        wp_enqueue_script(
            'webaura-repeator-admin-js',
            get_template_directory_uri() . '/assets/js/repeator-admin.js',
            ['jquery'],
            '1.0',
            true
        );
    }
}
add_action('admin_enqueue_scripts', 'webaura_repeator_admin_assets');
