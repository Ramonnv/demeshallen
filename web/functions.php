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

// Dropdown vullen met alle Gravity Forms formulieren
add_filter('acf/load_field/name=contact_form', function($field) {
    $field['choices'] = [];

    if (class_exists('GFAPI')) {
        $forms = GFAPI::get_forms();
        if (!empty($forms)) {
            foreach ($forms as $form) {
                $field['choices'][$form['id']] = $form['title'];
            }
        }
    }

    return $field;
});

// Dropdown in repeater (veld_id) vullen met velden van gekozen formulier
add_filter('acf/load_field/name=veld_id', function($field) {
    $form_id = get_field('contact_form');
    $field['choices'] = [];

    if ($form_id && class_exists('GFAPI')) {
        $form = GFAPI::get_form($form_id);

        if (!empty($form['fields'])) {
            foreach ($form['fields'] as $gf_field) {
                if (!empty($gf_field->id) && !empty($gf_field->label)) {
                    $field['choices'][$gf_field->id] = $gf_field->label;
                }
            }
        }
    }

    return $field;
});













			












run_fairbase_starter_theme();

