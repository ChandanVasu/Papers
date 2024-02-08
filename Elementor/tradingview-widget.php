<?php
// Make sure this file isn't accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Widget Class
class Custom_TradingView_Widget extends \Elementor\Widget_Base {
    public function get_name() {
        return 'custom-tradingview-widget';
    }

    public function get_title() {
        return __('Custom TradingView Widget', 'your-text-domain');
    }

    public function get_icon() {
        return 'eicon-editor-code';
    }

    public function get_categories() {
        return ['VASU-X'];
    }

    protected function render() {
        // Widget Content
        ?>
        <!-- TradingView Widget BEGIN -->
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/" rel="noopener nofollow" target="_blank"><span class="blue-text">Track all markets on TradingView</span></a></div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-technical-analysis.js" async>
            {
                "interval": "1m",
                "width": 425,
                "isTransparent": false,
                "height": 450,
                "symbol": "NSE:RELIANCE",
                "showIntervalTabs": true,
                "displayMode": "single",
                "locale": "en",
                "colorTheme": "light"
            }
            </script>
        </div>
        <!-- TradingView Widget END -->
        <?php
    }
}

// Register Widget
function register_custom_tradingview_widget() {
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new Custom_TradingView_Widget());
}

add_action('elementor/widgets/widgets_registered', 'register_custom_tradingview_widget');
