<?php
$selected_footer_template = get_theme_mod('footer_template', 'footer1'); // Get the selected footer template from customizer

// Include the selected footer template
get_template_part('Template/Fotter/'. $selected_footer_template);
?>
