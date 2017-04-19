<?php

function theme_customizer ( $wp_customize ) {
    
    $wp_customize->remove_section('static_front_page');
    
    $wp_customize->add_section('color_section', array(
        'title' => 'Custom Color Scheme',
        'description' => '',
        'priority' => 120,
    ) );
    $wp_customize->add_setting('highlight_color', array(
        'default' => '#87b401'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'highlight_color_value', array(
        'label' => 'Highlight Color',
        'section' => 'color_section',
        'settings' => 'highlight_color',
    ) ) );
    $wp_customize->add_setting('dark_color', array(
        'default' => '#0F373B'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'dark_color_value', array(
        'label' => 'Dark Color',
        'section' => 'color_section',
        'settings' => 'dark_color',
    ) ) );
    $wp_customize->add_setting('light_color', array(
        'default' => '#4B8287'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'light_color_value', array(
        'label' => 'Light Color',
        'section' => 'color_section',
        'settings' => 'light_color',
    ) ) );
     $wp_customize->add_setting('overlay_text_color', array(
        'default' => '#ffffff'
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'overlay_text_color', array(
        'label' => 'Overlay Text Color',
        'section' => 'color_section',
        'settings' => 'overlay_text_color',
    ) ) );
    
    //Logo SVG
    $wp_customize->add_section('logo_section', array(
        'title' => 'Logo',
        'description' => '',
        'priority' => 30,
    ) );
    $wp_customize->add_setting('logo_svg', array(
        'default' => '#4B8287'
    ) );
    $wp_customize->add_control('logo_svg_value', array(
        'label' => 'LOGO SVG',
        'section' => 'logo_section',
        'settings' => 'logo_svg',
        'type' => 'textarea',
    ) );
    
}

add_action( 'customize_register', 'theme_customizer', 20);

?>