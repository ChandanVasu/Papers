<?php

// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

class Custom_List_Post_Widget extends Widget_Base
{
    public function get_name()
    {
        return 'custom_list_post';
    }

    public function get_title()
    {
        return __('List Post View', 'vasux');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['VASU-X'];
    }

    protected function register_controls()
    {
        // Query settings section
        $this->start_controls_section(
            'query_settings',
            [
                'label' => __('Query Settings', 'vasux'),
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Posts Per Page', 'vasux'),
                'type' => Controls_Manager::NUMBER,
                'default' => 8,
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => __('Select Category', 'vasux'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_all_categories(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => __('Post Offset', 'vasux'),
                'type' => Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'vasux'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'ASC' => __('Ascending', 'vasux'),
                    'DESC' => __('Descending', 'vasux'),
                ],
                'default' => 'DESC',
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => __('Order By', 'vasux'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'date' => __('Date', 'vasux'),
                    'title' => __('Title', 'vasux'),
                    'rand' => __('Random', 'vasux'),
                ],
                'default' => 'date',
            ]
        );

        $this->add_control(
            'hide_image',
            [
                'label' => __('Hide Image', 'vasux'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'vasux'),
                'label_off' => __('No', 'vasux'),
            ]
        );

        $this->add_control(
            'hide_meta',
            [
                'label' => __('Hide Meta', 'vasux'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'vasux'),
                'label_off' => __('No', 'vasux'),
            ]
        );

        $this->add_control(
            'hide_excerpt',
            [
                'label' => __('Hide Excerpt', 'vasux'),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'vasux'),
                'label_off' => __('No', 'vasux'),
            ]
        );

        $this->end_controls_section();

        // Style settings section
        $this->start_controls_section(
            'style_settings',
            [
                'label' => __('Style Settings', 'vasux'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'vasux'),
                'selector' => '{{WRAPPER}} h1 a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_content_typography',
                'label' => __('Post Content Typography', 'vasux'),
                'selector' => '{{WRAPPER}} .elementor-list-post-content',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'author_meta_typography',
                'label' => __('Author Meta Typography', 'vasux'),
                'selector' => '{{WRAPPER}} .elementor-list-author-info',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__('Text Color', 'textdomain'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-list-post h1 a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'element_item_bg_color',
            [
                'label' => esc_html__('Element Item Background Color', 'textdomain'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-list-post-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'image_radius',
            [
                'label' => __('Image Radius', 'vasux'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-list-post-thumbnail img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Add more controls as needed...

        $this->end_controls_section();
    }

    protected function render()
    {
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
    }

    private function get_all_categories()
    {
        $categories = get_categories();
        $options = [];
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }
        return $options;
    }
}

// Register the widget
add_action('elementor/widgets/widgets_registered', function () {
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Custom_List_Post_Widget());
});
