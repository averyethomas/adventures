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
        'default' => '<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="40px" height="40px" viewBox="0 0 417.3 410.2" style="enable-background:new 0 0 417.3 410.2;" xml:space="preserve"><g><path class="st0" d="M99,362.8c-6.2,0.3-34,1.2-41.5,0.6c-3.1-0.3-4.7-3.6-4.7-9.8c0-27.1-0.3-84.2-0.9-171.3 C51.6,104.9,51.4,62.1,51.4,54c0-4.7,1.7-7.2,5.2-7.5l40.9-1.1c4.1,0,6.3-2.2,6.6-6.6c0-2.8,0.2-6.9,0.5-12.2 c0.6-5.6,0.5-8.9-0.5-9.8c-0.9-0.9-3.6-1.6-8-1.9c-25.7-1.6-48.6-1.6-68.7,0c-6.3,0.6-9.4,5.6-9.4,15 c0.6,105.5,0.8,222.8,0.5,351.9c0,3.1,0.3,5.9,0.9,8.4c0.9,3.7,2.7,5.6,5.1,5.6c20.3,0,44-0.3,71.1-0.9c5.9-0.6,8.9-3.4,8.9-8.4 v-16.8C104.3,365.1,102.4,362.8,99,362.8z"/><p>YOUR SVG LOGO</p><path class="st0" d="M249.2,282.8c0,0-6.4-7.7-23.7,0.3c-17.3,8-47.8,12.6-52.1,10.5c0,0-66.9-0.6-62.5-90.7 c4.3-90.1,33.8-108.4,66.3-116.7c0,0,21.4-3.5,41.4,8.3l13.3,8.6c0,0,12.5,5.9,10.8-8.6c-9.3-13.9-42-23.7-42-23.7 S156.9,60.2,126,92.4c-30.9,32.2-39.8,86.9-39.8,86.9s-16.8,90.7,34.4,131.2c10.8,10,33.3,16,33.3,16s36.6,13.3,98.6-20.4 c1.1-1.8,8-7.2,2.2-16.2L249.2,282.8z"/></g></svg>'
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