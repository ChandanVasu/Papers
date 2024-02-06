<?php
// Exit if accessed directly.
if (!defined('ABSPATH')) {
    exit;
}

class Custom_Grid_Post_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'custom_grid_post';
    }

    public function get_title()
    {
        return __('Grid Post View', 'vasux');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
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
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 8,
            ]
        );

        $this->add_control(
            'category',
            [
                'label' => __('Select Category', 'vasux'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_all_categories(),
                'multiple' => true,
            ]
        );

        $this->add_control(
            'offset',
            [
                'label' => __('Post Offset', 'vasux'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 0,
            ]
        );

        $this->add_control(
            'hide_image',
            [
                'label' => __('Hide Image', 'vasux'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'vasux'),
                'label_off' => __('No', 'vasux'),
            ]
        );

        $this->add_control(
            'hide_meta',
            [
                'label' => __('Hide Meta', 'vasux'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'default' => 'no',
                'label_on' => __('Yes', 'vasux'),
                'label_off' => __('No', 'vasux'),
            ]
        );

        $this->add_control(
            'hide_excerpt',
            [
                'label' => __('Hide Excerpt', 'vasux'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
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
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Title Typography', 'vasux'),
                'selector' => '{{WRAPPER}} h1 a',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'post_content_typography',
                'label' => __('Post Content Typography', 'vasux'),
                'selector' => '{{WRAPPER}} .elementor-grid-post-content',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'author_meta_typography',
                'label' => __('Author Meta Typography', 'vasux'),
                'selector' => '{{WRAPPER}} .elementor-grid-author-info',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => esc_html__( 'Text Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-grid-post h1 a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'element_item_bg_color',
            [
                'label' => esc_html__( 'Element Item Background Color', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-grid-post-item' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'image_radius',
            [
                'label' => __('Image Radius', 'vasux'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-grid-post-thumbnail img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Add more controls as needed...

        $this->end_controls_section();
    }

    protected function render()
    {
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

        // Check if there are posts
        if ($query->have_posts()) {
            echo '<div class="elementor-grid-post ">';

            // Start the loop
            while ($query->have_posts()) {
                $query->the_post();

                echo '<div class="elementor-grid-post-item">';

                if (has_post_thumbnail() && $settings['hide_image'] !== 'yes') {
                    echo '<a href="' . get_permalink() . '" class="elementor-grid-post-thumbnail">';
                    echo get_the_post_thumbnail();
                    $categories = get_the_category();
                    if (!empty($categories)) {
                        $category = $categories[0];
                        echo '<span class="elementor-grid-post-category">' . esc_html($category->name) . '</span>';
                    }
                    echo '</a>';
                }

                echo '<h1><a href="' . get_permalink() . '" style="' . $this->get_render_attribute_string('title_typography') . '">' . get_the_title() . '</a></h1>';

                $author_id = get_the_author_meta('ID');
                $author_avatar = get_avatar_url($author_id, array('size' => 50));
                $author_name = get_the_author_meta('display_name');
                if ($settings['hide_meta'] !== 'yes') {
                    echo '<div class="elementor-grid-author-info" style="' . $this->get_render_attribute_string('author_meta_typography') . '">';
                    echo '<img src="' . esc_url($author_avatar) . '" alt="' . esc_attr($author_name) . '" class="elementor-grid-author-avatar" />';
                    echo '<span class="elementor-grid-author-name ">' . esc_html($author_name) . '</span>';
                    echo '<span class="elementor-grid-post-date"> ⏱️ ' . get_the_date("j F Y") . '</span>';
                    echo '</div>';
                }

                if ($settings['hide_excerpt'] !== 'yes') {
                    echo '<div class="elementor-grid-post-content" style="' . $this->get_render_attribute_string('post_content_typography') . '">' . get_the_excerpt() . '</div>';
                }

                echo '</div>';
            }

            echo '</div>';

            wp_reset_postdata();
        } else {
            echo '<p>No posts found.</p>';
        }
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
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Custom_Grid_Post_Widget());
});
