<?php

/*
	===========================================================
	This file is automatically called by WordPress

	All the functionality is written across multiple classes
	inside the ./inc/ folder
	===========================================================
*/

if ( ! defined( 'FAIRBASE_DIR_PATH' ) ) {
	define( 'FAIRBASE_DIR_PATH', untrailingslashit( get_template_directory() ) );
}


//	===========================================================
// 	Requiring all helper classes
//	===========================================================
require_once FAIRBASE_DIR_PATH . '/inc/helpers/functionality.php';
require_once FAIRBASE_DIR_PATH . '/inc/helpers/environment.php';
require_once FAIRBASE_DIR_PATH . '/inc/helpers/autoloader.php';
require_once FAIRBASE_DIR_PATH . '/inc/helpers/google-tag-manager.php';
require_once FAIRBASE_DIR_PATH . '/inc/helpers/template-tags.php';
require_once FAIRBASE_DIR_PATH . '/inc/helpers/breadcrumbs.php';
require_once FAIRBASE_DIR_PATH . '/inc/helpers/array_helpers.php';


//	===========================================================
// 	Initiating FairBase theme
//	===========================================================
function run_fairbase_starter_theme() {
	\FAIRBASE_STARTER\Inc\FAIRBASE_STARTER_THEME::get_instance();
}









add_filter('gform_field_content', 'custom_gform_field_wrapper_by_id', 10, 5);

function custom_gform_field_wrapper_by_id($field_content, $field, $value, $lead_id, $form_id) {
    // Define custom wrapper classes for specific field IDs
    $gravity_settings = array(
        1 => 'Test',
        3 => 'class_two',
        5 => 'class_three',
    );

    // Check if this field ID has a custom class
    if (array_key_exists($field->id, $gravity_settings)) {
        $custom_svg = $gravity_settings[$field->id];

        // Wrap the original field content with a div with the custom class
        $field_content = sprintf(
            '
				<div class="custom-thingie">
                            %s
                            %s
                        </div>

			',
            $custom_svg,
            $field_content
        );
    }

    return $field_content;
}










			












run_fairbase_starter_theme();

