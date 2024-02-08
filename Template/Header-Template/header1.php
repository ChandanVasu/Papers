<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    
</head>
<body <?php body_class(); ?>>
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <!-- Use WordPress menu here -->
        <?php if ( has_custom_logo() ) : ?>
                    <div class="site-logo"><?php the_custom_logo(); ?></div>
                <?php else : ?>
                    <?php if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                    <?php else : ?>
                        <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <?php endif; ?>
                <?php endif; ?>

        <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'menu_id'        => 'primary-menu-id',
                'container'      => false,
                'menu_class'     => 'sidenav-menu'
            ));
        ?>
        
        
    </div>

    <header id="header1">
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

            

            <!-- Add your navigation menu here if needed -->
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
            </nav>

            <img src="<?php echo get_template_directory_uri(); ?>/assets/paragraph.png" alt="" width="30px" height="30px" onclick="openNav()">


            <!-- Add a button to open the side navigation menu -->
            <!-- <span clsaa = 'threeline-vasu'style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span> -->
        </div><!-- .header1-container -->
    </header><!-- #header1 -->

    <?php wp_footer(); ?>
    
    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>
</html>
