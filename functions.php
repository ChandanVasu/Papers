<?php

// Theme Setup
function theme_setup() {
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    register_nav_menus(array(
        'primary-menu' => __('Primary Menu', 'your-theme-textdomain'),
    ));
    register_nav_menus(array(
        'hearder-menu' => __('Header Menu', 'your-theme-textdomain'),
    ));
}

add_action('after_setup_theme', 'theme_setup');




include_once get_template_directory() . '/includes/other-functionality.php';
include_once get_template_directory() . '/includes/Register-elementor.php';
// include_once get_template_directory() . '/includes/Vasux.php';




// Register oEmbed Widget
if (!function_exists('register_oembed_widget')) {
    function register_oembed_widget($widgets_manager) {
        require_once(__DIR__ . '/Elementor/oembed-widget.php');
        $widgets_manager->register(new \Elementor_oEmbed_Widget());
    }
    add_action('elementor/widgets/register', 'register_oembed_widget');
}

// Register Custom Grid Post Widget
if (!function_exists('register_custom_grid_post_widget')) {
    function register_custom_grid_post_widget($widgets_manager) {
        require_once(__DIR__ . '/Elementor/gridpost.php');
        $widgets_manager->register_widget_type(new \Custom_Grid_Post_Widget());
    }

    add_action('elementor/widgets/register', 'register_custom_grid_post_widget');
}

if (!function_exists('register_custom_list_post_widget')) {
    function register_custom_list_post_widget($widgets_manager) {
        require_once(__DIR__ . '/Elementor/listpost.php');
        $widgets_manager->register_widget_type(new \Custom_List_Post_Widget());
    }

    add_action('elementor/widgets/register', 'register_custom_list_post_widget');
}

if (!function_exists('register_custom_author_widget')) {
    function register_custom_author_widget($widgets_manager) {
        require_once(__DIR__ . '/Elementor/author-list.php');
        $widgets_manager->register_widget_type(new \Author_List_Widget());
    }

    add_action('elementor/widgets/register', 'register_custom_author_widget');
}



add_action('elementor/elements/categories_registered', 'add_elementor_widget_categories');




function your_theme_register_header_style_customizer($wp_customize) {
    $wp_customize->add_section('header_section', array(
        'title' => __('Header Style', 'your-theme'),
        'priority' => 30,
    ));
 
    $wp_customize->add_setting('header_style_setting', array(
        'default' => 'header1', // Set Header Style 1 as default
        'sanitize_callback' => 'sanitize_text_field',
    ));
 
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
 }
 add_action('customize_register', 'your_theme_register_header_style_customizer');
 

 
 