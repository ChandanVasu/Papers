<?php

function your_theme_register_header_style_customizer($wp_customize) {
    // Add section for header style
    $wp_customize->add_section('header_section', array(
        'title' => __('Header Style', 'your-theme'),
        'priority' => 30,
    ));

    // Header style setting
    $wp_customize->add_setting('header_style_setting', array(
        'default' => 'header1', // Set Header Style 1 as default
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Header style control
    $wp_customize->add_control('header_style_control', array(
        'label' => __('Select Header Style', 'your-theme'),
        'section' => 'header_section',
        'settings' => 'header_style_setting',
        'type' => 'select',
        'choices' => array(
            'header1' => __('Header Style 1', 'your-theme'),
            'header2' => __('Header Style 2', 'your-theme'),
            'header3' => __('Header Style 3', 'your-theme'),
            'header4' => __('Header Style 4', 'your-theme'),
        ),
    ));

    // Add control for sticky header

    // Add control for header background color
    $wp_customize->add_setting('header_background_color_setting', array(
        'default' => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
    ));

    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_background_color_control', array(
        'label' => __('Header Background Color', 'your-theme'),
        'section' => 'header_section',
        'settings' => 'header_background_color_setting',
    )));
}

add_action('customize_register', 'your_theme_register_header_style_customizer');

 
 function custom_theme_menu() {
    // Add a top-level menu item to the WordPress dashboard
    add_menu_page(
        'Custom Theme Settings', // Page title
        'Theme Settings', // Menu title
        'manage_options', // Capability required to access this menu
        'custom-theme-settings', // Menu slug (unique identifier)
        'custom_theme_settings_page', // Callback function to display the page content
        'dashicons-admin-generic', // Icon for the menu item (optional)
        30 // Position of the menu item
    );
}
add_action('admin_menu', 'custom_theme_menu');

function custom_theme_settings_page() {
    // Display the content of your custom settings page here
    echo '<div class="wrap">';
    echo '<h2>Custom Theme Settings</h2>';
    echo '<p>This is where you can customize your theme settings.</p>';
    echo '</div>';
}


