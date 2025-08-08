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

















			












run_fairbase_starter_theme();

