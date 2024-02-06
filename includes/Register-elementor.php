<?php

function add_elementor_widget_categories( $elements_manager ) {

	$categories = [];
	$categories['VASU-X'] =
		[
			'title' => 'VASU-X',
			'icon'  => 'fa fa-plug'
		];

	$old_categories = $elements_manager->get_categories();
	$categories = array_merge($categories, $old_categories);

	$set_categories = function ( $categories ) {
		$this->categories = $categories;
	};

	$set_categories->call( $elements_manager, $categories );

}


