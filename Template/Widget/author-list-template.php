<?php
ob_start();

$settings = $this->get_settings();

// Your rendering logic here
$authors = get_users(['role__in' => $settings['roles'], 'exclude' => explode(',', $settings['excluded']), 'orderby' => 'display_name']);

if (!empty($authors)) {
    ?>
    <div class="author-list-container" id="<?php echo esc_attr( $this->get_id() ); ?>">
        <button class="scroll-btn prev-btn"><i class="fas fa-chevron-left"></i></button> <!-- Previous button -->
        <ul class="author-list-widget">
            <?php foreach ($authors as $author) {
                $author_link = get_author_posts_url($author->ID);
                $avatar = get_avatar($author->ID, 32);
                $biography = get_the_author_meta('description', $author->ID);
                $post_count = count_user_posts($author->ID); // Get total post count for the author
                ?>
                <li>
                    <?php if (!empty($avatar)) {
                        echo $avatar;
                    } ?>
                    <p class="total-post"><?php echo $post_count; ?></p>
                    <a href="<?php echo $author_link; ?>"><?php echo $author->display_name; ?></a>
                    <?php if (!empty($biography)) {
                        echo '<p class="biography">' . $biography . '</p>';
                    } ?>
                </li>
            <?php } ?>
        </ul>
        <button class="scroll-btn next-btn"><i class="fas fa-chevron-right"></i></button> <!-- Next button -->
    </div>
    <?php
} else {
    echo 'No authors found.';
}

$output = ob_get_clean();
echo $output;
?>

<script>
    // Retrieve text length for this widget
    var maxLength = <?php echo !empty($settings['text_length']) ? $settings['text_length'] : 150; ?>;

    // Trim text in each paragraph
    var paragraphs = document.querySelectorAll('#<?php echo esc_attr( $this->get_id() ); ?> .biography');
    paragraphs.forEach(function(paragraph) {
        var text = paragraph.textContent.trim();
        if (text.length > maxLength) {
            text = text.substring(0, maxLength) + '...';
        }
        paragraph.textContent = text;
    });
</script>
