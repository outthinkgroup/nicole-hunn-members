<?php
/**
 * nicole hunn members Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nicole hunn members
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION', '1.0.0' );
define('NHM_DIR', get_stylesheet_directory());
define('NHM_URL', get_stylesheet_directory_uri());
/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'nicole-hunn-members-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, 'all' );
	wp_enqueue_style( 'nicole-hunn-members-global-css', get_stylesheet_directory_uri() . '/assets/global.css', array('astra-theme-css'), CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, 'all' );
	

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );



// error_reporting (-1);
// ini_set('error_reporting', E_ALL);


include_once NHM_DIR . '/components/index.php';
include_once NHM_DIR . '/templates/index.php';
include_once NHM_DIR . '/customfields/customfields.php';

include_once NHM_DIR . '/get-icon.php';
include_once NHM_DIR . '/navigation_setup.php';

	

