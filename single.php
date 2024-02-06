<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php get_header(); ?>

    <!-- Main Content Container -->
    <div class="container">
        <!-- Primary Content Area -->
        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">

                <?php
                while (have_posts()) :
                    the_post();

                    // Display post title
                    the_title('<h1>', '</h1>');

                    // Get author information
                    $author_id = get_the_author_meta('ID');
                    $author_avatar = get_avatar_url($author_id, array('size' => 50));
                    $author_name = get_the_author_meta('display_name');

                    // Display author information
                    echo '<div class="author-info">';
                    echo '<img src="' . esc_url($author_avatar) . '" alt="' . esc_attr($author_name) . '" class="author-avatar">';
                    echo '<span class="author-name">' . esc_html($author_name) . '</span>';
                    echo '<span class="post-date"> ⏱️ ' . get_the_date("j F Y") . '</span>';

                    // Add social media links
                    $twitter_url = get_the_author_meta('twitter');
                    $facebook_url = get_the_author_meta('facebook');
                    $instagram_url = get_the_author_meta('instagram');

                    if ($twitter_url || $facebook_url || $instagram_url) {
                        echo '<div class="social-media-links">';
                        if ($twitter_url) {
                            echo '<a href="' . esc_url($twitter_url) . '" target="_blank" rel="noopener noreferrer"><img src="https://w7.pngwing.com/pngs/748/680/png-transparent-twitter-x-logo-thumbnail.png" alt="Twitter"></a>';
                        }
                        if ($facebook_url) {
                            echo '<a href="' . esc_url($facebook_url) . '" target="_blank" rel="noopener noreferrer"><img src="https://upload.wikimedia.org/wikipedia/commons/6/6c/Facebook_Logo_2023.png" alt="Facebook"></a>';
                        }
                        if ($instagram_url) {
                            echo '<a href="' . esc_url($instagram_url) . '" target="_blank" rel="noopener noreferrer"><img src="https://cdn3.iconfinder.com/data/icons/2018-social-media-logotypes/1000/2018_social_media_popular_app_logo_instagram-512.png" alt="Instagram"></a>';
                        }
                        echo '</div>';
                    }

                    echo '</div>';

                    // Display featured image with a custom class
                    if (has_post_thumbnail()) :
                        $thumbnail_id = get_post_thumbnail_id();
                        $thumbnail_url = wp_get_attachment_image_src($thumbnail_id, 'large', true);
                        $thumbnail_class = 'custom-thumbnail-class'; // Add your custom class here

                        echo '<div class="post-thumbnail ' . $thumbnail_class . '">';
                        echo '<img src="' . esc_url($thumbnail_url[0]) . '" alt="' . esc_attr(get_the_title()) . '" class="' . esc_attr($thumbnail_class) . '">';
                        echo '</div>';
                    endif;

                    // Display post content
                    the_content();

                    // Allow comments


                endwhile; // End of the loop.
?>

            </main><!-- #main -->
        </div><!-- #primary -->

        <!-- Sidebar Area -->
     
        <div class='commentbox-area'> <?php if (comments_open() || get_comments_number()) :
            comments_template('comment');


        endif; ?> </div> 

                   

    </div><!-- .container -->

</body>
</html>
