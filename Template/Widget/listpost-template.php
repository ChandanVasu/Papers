<?php


$settings = $this->get_settings_for_display();
$posts_per_page = !empty($settings['posts_per_page']) ? $settings['posts_per_page'] : 5;
$category = !empty($settings['category']) ? $settings['category'] : [];
$offset = !empty($settings['offset']) ? $settings['offset'] : 0;
$order = !empty($settings['order']) ? $settings['order'] : 'DESC';
$orderby = !empty($settings['orderby']) ? $settings['orderby'] : 'date';

// Query posts
$query_args = array(
    'post_type' => 'post',
    'posts_per_page' => $posts_per_page,
    'category__in' => $category,
    'offset' => $offset,
    'order' => $order,
    'orderby' => $orderby,
);

$query = new WP_Query($query_args);

// Check if there are posts
if ($query->have_posts()) :
?>
    <div class="elementor-list-post">
        <?php
        // Start the loop
        while ($query->have_posts()) :
            $query->the_post();
        ?>
            <div class="elementor-list-post-item">
                <?php if (has_post_thumbnail() && $settings['hide_image'] !== 'yes') : ?>
                    <a href="<?php echo get_permalink(); ?>" class="elementor-list-post-thumbnail">
                        <?php echo get_the_post_thumbnail(get_the_ID(), 'full'); ?>
                    </a>
                <?php endif; ?>

                <div class="elementor-list-content-wrap">
                    <h1>
                        <a href="<?php echo get_permalink(); ?>" style="<?php echo $this->get_render_attribute_string('title_typography'); ?>">
                            <?php echo get_the_title(); ?>
                        </a>
                    </h1>

                    <?php
                    $categories = get_the_category();
                    if (!empty($categories) && $settings['hide_meta'] !== 'yes') :
                        $category = $categories[0];
                    ?>
                        <span class="elementor-list-post-category"><?php echo esc_html($category->name); ?></span>
                    <?php endif; ?>

                    <?php
                    $author_id = get_the_author_meta('ID');
                    $author_avatar = get_avatar_url($author_id, array('size' => 50));
                    $author_name = get_the_author_meta('display_name');
                    if ($settings['hide_meta'] !== 'yes') :
                    ?>
                        <div class="elementor-list-author-info">
                            <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>" class="elementor-list-author-avatar" />
                            <span class="elementor-list-author-name"><?php echo esc_html($author_name); ?></span>
                            <span class="elementor-list-post-date"> ⏱️ <?php echo get_the_date("j F Y"); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($settings['hide_excerpt'] !== 'yes') : ?>
                        <div class="elementor-list-post-excerpt" style="<?php echo $this->get_render_attribute_string('post_content_typography'); ?>">
                            <?php echo get_the_excerpt(); ?>
                        </div>
                    <?php endif; ?>
                </div><!-- .elementor-list-content-wrap -->
            </div><!-- .elementor-list-post-item -->
        <?php endwhile; ?>
    </div><!-- .elementor-list-post -->
<?php
    wp_reset_postdata();
else :
    echo '<p>No posts found.</p>';
endif;
