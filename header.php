<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package YourThemeName
 */

$selected_header_style = get_theme_mod('header_style_setting', 'header1'); // Get the selected header style from Customizer

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <script src="https://kit.fontawesome.com/34e6d2d9a0.js" crossorigin="anonymous"></script>

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php get_template_part( 'Template/Header-Template/' . $selected_header_style, 'template' ); ?>
