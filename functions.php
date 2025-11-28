<?php

// Add theme support for page title
add_theme_support('title-tag');


// Added CSS, Jquerry, Google Fornt Etc
function enqueue_webaura_css_js(){

    // Link style.css
    wp_enqueue_style('webaura_style_css',get_stylesheet_uri(  ));

    // Register & Link custom.css
    wp_register_style('webaura_custom_css', get_template_directory_uri(). '/assets/css/custom.css');
    wp_enqueue_style('webaura_custom_css');

    // Link Bootstrap CSS
    wp_register_style('webaura_bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css');
    wp_enqueue_style('webaura_bootstrap');

    
    // Link wordpress js
    wp_enqueue_script('jquerry');
    
    // Register & Link scripts.js
    wp_register_script('webaura_script_js',get_template_directory_uri().'/assets/js/scripts.js');
    wp_enqueue_script('webaura_script_js');

    // Link Bootstrap JS
    wp_register_script('webaura_bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js');
    wp_enqueue_script('webaura_bootstrap');

    // Linked Google Fonts
    wp_register_style('webaura_fonts','https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    wp_enqueue_style('webaura_fonts');

}
add_action('wp_enqueue_scripts','enqueue_webaura_css_js');


// Added Menu
register_nav_menu('main_menu',__('Primary Menu', 'webaura'));



// Navigation Bar Positon Customization
function webaura_header_customizer($wp_customize){
    $wp_customize->add_section('webaura_header_customizer', array(
        'title' => 'WebAura Header',
        'description' => 'You can customize the header from here',
    ));
    $wp_customize->add_setting('webaura_logo',array(
        'default' => 'WebAura',
    ));
    $wp_customize->add_control( 'webaura_logo', array(
        'label' => 'WebAura Logo',
        'description' => 'You can change the logo from here',
        'section' => 'webaura_header_customizer',
        'setting' => 'webaura_logo',
        'type' => 'text',
    ));
}
add_action('customize_register', 'webaura_header_customizer');


?>