<?php
ob_start();

$settings = $this->get_settings();

// Your rendering logic here
$authors = get_users(['role__in' => $settings['roles'], 'exclude' => explode(',', $settings['excluded']), 'orderby' => 'display_name']);

if (!empty($authors)) {
    ?>
    <div class="author-list-container">
        <div class="author-list-widget" id="authorList">
            <?php foreach ($authors as $author) { ?>
                <div class="author-card">
                    <?php
                    $author_link = get_author_posts_url($author->ID);
                    $avatar = get_avatar($author->ID, 120); // Increased avatar size for card view
                    $biography = get_the_author_meta('description', $author->ID);
                    $post_count = count_user_posts($author->ID); // Get total post count for the author
                    ?>
                    <div class="author-avatar"><?php echo $avatar; ?></div>
                    <div class="author-details">
                        <p class="author-name"><a href="<?php echo $author_link; ?>"><?php echo $author->display_name; ?></a></p>
                        <p class="total-post"><?php echo $post_count; ?> Posts</p>
                        <?php if (!empty($biography)) {
                            echo '<p class="biography">' . $biography . '</p>';
                        } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <?php
} else {
    echo 'No authors found.';
}

$output = ob_get_clean();
echo $output;
?>
