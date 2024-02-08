<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header id="header1" style="background-color: <?php echo get_theme_mod('header_background_color_setting', '#ffffff'); ?>">
        <div class="header1-container">
            <div class="site-branding headerlogo headerlogo-1">
                <?php if ( has_custom_logo() ) : ?>
                    <div class="site-logo"><?php the_custom_logo(); ?></div>
                <?php else : ?>
                    <?php if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif; ?>
                <?php endif; ?>
                <p class="site-description"><?php bloginfo( 'description' ); ?></p>
            </div><!-- .site-branding -->
            <nav id="site-navigation" class="main-navigation-header-1" role="navigation">
                <?php
                   wp_nav_menu(array(
                       'theme_location' => 'primary-menu',
                       'menu_id'        => 'primary-menu-id',
                       'container'      => 'nav',
                       'container_class'=> 'primary-menu-container',
                       'menu_class'     => 'primary-menu-class'
                   ));
            
                ?>
            </nav><!-- #site-navigation -->
        </div><!-- .container -->
    </header><!-- #masthead -->
