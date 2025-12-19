<?php

/* ====================
This Template for the Custom Post Type - Question  
====================*/


// 1. Register Post Type
function question_builder(){
    register_post_type( 'question' ,array(
        'labels' => array(
            'name' => 'Question',
            'singular_name' => 'Question',
        ),
        'menu_icon' => 'dashicons-format-status',
        'public' => true,
        'publicly_queryable' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'question'),
        'supports' => array('title'),
    ));
}
add_action('init', 'question_builder');


// 2. Add Meta Box
function question_builder_meta_box(){
    add_meta_box(
        'question_id',
        'Question & Answer',
        'question_builder_meta_box_callback',
        'question',
        'normal',
        'high',
    );
}
add_action('add_meta_boxes', 'question_builder_meta_box');


// 3. Meta box UI
function question_builder_meta_box_callback($post){

    wp_nonce_field('question_builder_nonce','question_builder_nonce_field');

    $questions = get_post_meta($post->ID, '_questions', true);
    $questions = is_array($questions) ? $questions : [];

    if(empty($questions)){
        $questions[]  =  [
            'question' => '',
            'type' => 'text',
            'answer' => '',
            'options' => [''],
        ];
    }

    ?>
        <div class="questions-wrapper">
            <!-- Loop -->
            <?php 
                foreach ($questions as $index => $q):
            ?>
                <div class="question-items">

                    <!-- Question Field -->
                     <div class="question-box">
                         <label for="question">Question</label>
                         <input type="text" name="qst[<?php echo esc_attr( $index );?>][question]" value="<?php echo esc_attr($q['question']); ?>">
                     </div>

                   <div class="answer">
                         <!-- Type -->
                        <div class="question-type">
                            <label for="type">Type</label>
                            <select name="qst[<?php echo $index; ?>][type]" class="question_type">
                                <option value="text" <?php selected( $q['type'],'text'); ?>>Text</option>
                                <option value="radio" <?php selected( $q['type'],'radio'); ?>>Radio</option>
                            </select>
                        </div>

                        <!-- Text (Type) -->
                        <div class="type-text">
                            <input type="text" name="qst[<?php echo $index; ?>][answer]" value="<?php echo esc_attr( $q['answer']); ?>" placeholder="Short answer">
                        </div>

                        <!-- Radio (Type) -->
                        <div class="type-radio">
                            <?php
                                $options = isset($q['options']) && is_array($q['options']) ? $q['options'] : [''];
                                foreach ($options as $opt) :
                            ?>
                                <input type="text" name="qst[<?php echo $index; ?>][options][]" value="<?php echo esc_attr( $opt ); ?>" placeholder="Option">
                            <?php endforeach; ?>
                            <button type="button" class="add-option button-primary">Add Option</button>
                        </div>
                   </div>

                   <!-- Remove Button -->
                    <button type="button" class="remove-question button button-secondary">
                        Remove
                    </button>

                </div>

            <?php endforeach ?>
            <!-- End Loop -->
        </div>

        <div class="questions-btn">
            <button type="button" id="add_question" class="add_question_btn button-primary">Add Question</button>
        </div>
    <?php
}


// 4. Save Meta
function question_builder_save_meta($post_id){

    if(get_post_type( $post_id ) !== 'question') return ;
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return ; 
    if( ! current_user_can( 'edit_post', $post_id )) return;

    if( ! isset($_POST['question_builder_nonce_field']) || ! wp_verify_nonce($_POST['question_builder_nonce_field'], 'question_builder_nonce')) return;

    if ( isset($_POST['qst']) && is_array($_POST['qst']) ) {

        $clean = [];

        foreach ($_POST['qst'] as $q) {
            $clean[] = [
                'question' => sanitize_text_field($q['question'] ?? ''),
                'type'     => sanitize_text_field($q['type'] ?? 'text'),
                'answer'   => sanitize_text_field($q['answer'] ?? ''),
                'options'  => isset($q['options'])
                    ? array_map('sanitize_text_field', $q['options'])
                    : [],
            ];
        }

        update_post_meta($post_id, '_questions', $clean);
    }

}
add_action('save_post', 'question_builder_save_meta');


//  5. Enqueue JS & CSS
add_action('admin_enqueue_scripts', function ($hook) {

    // Only load on post editor pages
    if ($hook !== 'post.php' && $hook !== 'post-new.php') {
        return;
    }

    wp_enqueue_script(
        'question-builder-js',
        get_template_directory_uri() . '/assets/js/question-builder.js',
        ['jquery'],
        time(), // cache-busting
        true
    );

    wp_enqueue_style(
        'question-builder-css',
        get_template_directory_uri() . '/assets/css/question-builder.css',
        [],
        time()
    );
});
