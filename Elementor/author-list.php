<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Author_List_Widget extends Widget_Base {

    public function get_name() {
        return 'author_list';
    }

    public function get_title() {
        return 'Author List';
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return ['VASU-X'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_settings',
            [
                'label' => __('General', 'your-text-domain'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'roles',
            [
                'label' => __('Select User Roles', 'your-text-domain'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'default' => ['administrator'],
                'options' => $this->get_user_roles(),
            ]
        );

        $this->add_control(
            'excluded',
            [
                'label' => __('Exclude User IDs:', 'your-text-domain'),
                'type' => Controls_Manager::TEXT,
            ]
        );

        // Add control for text length
        $this->add_control(
            'text_length',
            [
                'label' => __('Text Length', 'your-text-domain'),
                'type' => Controls_Manager::NUMBER,
                'default' => 150, // Default text length
                'description' => __('Enter the maximum length of text to display.', 'your-text-domain'),
            ]
        );

        $this->end_controls_section();

        // Add style controls
        $this->start_controls_section(
            'section_style',
            [
                'label' => __('Style', 'your-text-domain'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'list_item_spacing',
            [
                'label' => __('List Item Spacing', 'your-text-domain'),
                'type' => Controls_Manager::SLIDER,
                'selectors' => [
                    '{{WRAPPER}} .author-list-widget ul li' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Add more style controls as needed

        $this->end_controls_section();
    }

    protected function render() {
        // Get the text length setting value
        // $settings = $this->get_settings_for_display();
        // $text_length = !empty($settings['text_length']) ? $settings['text_length'] : 100;
    
        // // Pass the text length to the template
        // $widget_id = $this->get_id();
        // echo '<script>var textLength_' . $widget_id . ' = ' . $text_length . ';</script>';
    
        // Include the template file
        include get_template_directory() . '/Template/Widget/author-list-template.php';
    }
    
    

    
    private function get_user_roles() {
        $roles = [];
        $wp_roles = new \WP_Roles();
        if (!empty($wp_roles)) {
            foreach ($wp_roles->roles as $role_name => $role_info) {
                $roles[$role_name] = $role_info['name'];
            }
        }
        return $roles;
    }
}

// Register the widget
function register_author_list_widget() {
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Author_List_Widget());
}
add_action('elementor/widgets/widgets_registered', 'register_author_list_widget');

?>
