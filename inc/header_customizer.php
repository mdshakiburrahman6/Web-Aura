<?php

// Added Menu
register_nav_menu('main_menu',__('Primary Menu', 'webaura'));



// Navigation Bar Positon Customization
function webaura_header_customizer($wp_customize){

    // Logo Change funtionality
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

    // Navbar position Change 
    $wp_customize->add_section('webaura_nav_customizer', array(
        'title' => 'WebAura Nav',
        'description' => 'You can customize the header from here',
    ));
    $wp_customize->add_setting('webaura_nav_position',array(
        'default' => 'right_menu',
    ));
    $wp_customize->add_control('webaura_nav_position', array(
        'label' => 'WebAura Navigation Bar',
        'description' => 'You can change the navigation bar position from here.',
        'section' => 'webaura_header_customizer',
        'setting' => 'webaura_nav_position',
        'type' => 'radio',
        'choices' => array(
            'left_menu' => 'Left Menu',
            'right_menu' => 'Right Menu',
            'center_menu' => 'Center Menu',
        ) ,
    ));


}
add_action('customize_register', 'webaura_header_customizer');
