<?php wp_footer(); ?>
</body>
<footer>
    <div class="footer-columns">
        <div class="footer-column">
            <h2>Recent Posts</h2>
            <ul>
                <?php
                $recent_posts = wp_get_recent_posts(array('numberposts' => 5));
                foreach ($recent_posts as $post) :
                    setup_postdata($post);
                ?>
                    <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                <?php endforeach;
                wp_reset_postdata(); ?>
            </ul>
        </div>
        <div class="footer-column">
            <h2>Footer Menu</h2>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary-menu',
                'container' => false,
                'menu_class' => 'primary-menu',
            ));
            ?>
        </div>
        <div class="footer-column">
            <h2>Popular Posts</h2>
            <ul>
                <?php
                // Query to get popular posts, you need to implement this logic
                ?>
                <li>Popular Post 1</li>
                <li>Popular Post 2</li>
                <li>Popular Post 3</li>
            </ul>
        </div>
    </div>
</footer>
</html>
