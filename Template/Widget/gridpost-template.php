<?php


$settings = $this->get_settings_for_display();
$posts_per_page = isset($settings['posts_per_page']) ? $settings['posts_per_page'] : 5;
$category = isset($settings['category']) ? $settings['category'] : [];
$offset = isset($settings['offset']) ? $settings['offset'] : 0;

// Query posts
$query_args = array(
    'post_type'      => 'post',
    'posts_per_page' => $posts_per_page,
    'category__in'   => $category,
    'offset'         => $offset,
);

$query = new WP_Query($query_args);

// Start output buffering
ob_start();

// Check if there are posts
if ($query->have_posts()) {
?>
    <div class="elementor-grid-post ">
    <?php
    // Start the loop
    while ($query->have_posts()) {
        $query->the_post();
    ?>
        <div class="elementor-grid-post-item">
            <?php
            if (has_post_thumbnail() && isset($settings['hide_image']) && $settings['hide_image'] !== 'yes') {
            ?>
                <a href="<?php echo get_permalink(); ?>" class="elementor-grid-post-thumbnail">
                    <?php echo get_the_post_thumbnail(); ?>
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        $category = $categories[0];
                    ?>
                        <span class="elementor-grid-post-category"><?php echo esc_html($category->name); ?></span>
                    <?php
                    }
                    ?>
                </a>
            <?php
            }
            ?>
            <h1><a href="<?php echo get_permalink(); ?>" style="<?php echo $this->get_render_attribute_string('title_typography'); ?>"><?php echo get_the_title(); ?></a></h1>
            <?php
            $author_id = get_the_author_meta('ID');
            $author_avatar = get_avatar_url($author_id, array('size' => 50));
            $author_name = get_the_author_meta('display_name');
            if (isset($settings['hide_meta']) && $settings['hide_meta'] !== 'yes') {
            ?>
                <div class="elementor-grid-author-info" style="<?php echo $this->get_render_attribute_string('author_meta_typography'); ?>">
                    <img src="<?php echo esc_url($author_avatar); ?>" alt="<?php echo esc_attr($author_name); ?>" class="elementor-grid-author-avatar" />
                    <span class="elementor-grid-author-name "><?php echo esc_html($author_name); ?></span>
                    <span class="elementor-grid-post-date"> ⏱️ <?php echo get_the_date("j F Y"); ?></span>
                </div>
            <?php
            }
            ?>
            <?php
             if ($settings['hide_excerpt'] !== 'yes') {
            ?>
                <div class="elementor-grid-post-content" style="<?php echo $this->get_render_attribute_string('post_content_typography'); ?>"><?php echo get_the_excerpt(); ?></div>
            <?php
            }
            ?>
        </div>
    <?php
    }
    ?>
    </div>
<?php
    wp_reset_postdata();
} else {
    echo '<p>No posts found.</p>';
}

// Get the buffered content and clean the buffer
$rendered_content = ob_get_clean();

// Output the rendered content
echo $rendered_content;
