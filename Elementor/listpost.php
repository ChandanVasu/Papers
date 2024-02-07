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

    protected function render() {
        // Include the template file
        include get_template_directory() . '/Template/Widget/listpost-template.php';
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
