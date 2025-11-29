<?php

// Footer Customization
function webaura_footer_cusromize($wp_customize){
    $wp_customize->add_section('webaura_footer_customizer', array(
        'title' => 'WebAura Footer',
        'description' => 'You can customize the footer from here',
    ));
    $wp_customize->add_setting('webaura_copyright_text', array(
        'default' => '&copy; 2025 WebAura. All Copyright Reserved',
    ));
    $wp_customize->add_control('webaura_copyright_text', array(
        'label' => 'Copyright Text',
        'description' => 'You can change the copyright text from here',
        'section' => 'webaura_footer_customizer',
        'setting' => 'webaura_copyright_text',
    ));
}
add_action('customize_register','webaura_footer_cusromize');