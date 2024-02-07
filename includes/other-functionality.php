<?php 


// Enqueue Styles and Scripts
function enqueue_styles_and_scripts() {
    wp_enqueue_style('main-style', get_stylesheet_uri());
    wp_enqueue_style('custom-style-grid-post', get_template_directory_uri() . '/Style/Elementor/gridpost.css');
    wp_enqueue_style('single-post', get_template_directory_uri() . '/Style/single-post.css');
    wp_enqueue_style('custom-style-list-post', get_template_directory_uri() . '/Style/Elementor/listpost.css');
    wp_enqueue_style('custom-style-author', get_template_directory_uri() . '/Style/Elementor/author.css');
    wp_enqueue_style('custom-styles-gridpost', get_template_directory_uri() . '/Style/Gridpost.css');
    wp_enqueue_style('custom-styles-comment', get_template_directory_uri() . '/Style/comment_box.css');
    wp_enqueue_style('header-css', get_template_directory_uri() . '/Style/header-css.css');
}

add_action('wp_enqueue_scripts', 'enqueue_styles_and_scripts');



function enqueue_custom_scripts() {
    // Enqueue custom JavaScript file
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/Jsfile/custom.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');





function enqueue_theme_control_panel_styles() {
    wp_enqueue_style('theme-control-panel-styles', get_template_directory_uri() . '/Style/theme-control-panel-style.css');
}
add_action('admin_enqueue_scripts', 'enqueue_theme_control_panel_styles');



// Logo Call Function

function theme_custom_logo_setup() {
    add_theme_support('custom-logo', array(
        'height'      => 50,
        'width'       => 150,
        'flex-height' => true,
        'flex-width'  => true,
    ));
}

add_action('after_setup_theme', 'theme_custom_logo_setup');


function add_social_media_fields($user)
{
    ?>
    <h3><?php _e('Social Media Links', 'textdomain'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="twitter"><?php _e('Twitter', 'textdomain'); ?></label></th>
            <td>
                <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="facebook"><?php _e('Facebook', 'textdomain'); ?></label></th>
            <td>
                <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>">
            </td>
        </tr>
        <tr>
            <th><label for="instagram"><?php _e('Instagram', 'textdomain'); ?></label></th>
            <td>
                <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr(get_the_author_meta('instagram', $user->ID)); ?>">
            </td>
        </tr>
    </table>
    <?php
}
add_action('show_user_profile', 'add_social_media_fields');
add_action('edit_user_profile', 'add_social_media_fields');

// Save custom fields
function save_social_media_fields($user_id)
{
    if (current_user_can('edit_user', $user_id)) {
        update_user_meta($user_id, 'twitter', sanitize_text_field($_POST['twitter']));
        update_user_meta($user_id, 'facebook', sanitize_text_field($_POST['facebook']));
        update_user_meta($user_id, 'instagram', sanitize_text_field($_POST['instagram']));
    }
}
add_action('personal_options_update', 'save_social_media_fields');
add_action('edit_user_profile_update', 'save_social_media_fields');


