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
define('NHM_DIR', get_stylesheet_directory());
define('NHM_URL', get_stylesheet_directory_uri());
define('NICOLE_USER_ID', 1433);

include_once NHM_DIR . '/theme-version.php';
/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'nicole-hunn-members-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), NHM_VERSION, 'screen' );
	wp_enqueue_style( 'nicole-hunn-members-global-css', get_stylesheet_directory_uri() . '/assets/global.css', array('astra-theme-css'), NHM_VERSION, 'screen' );
	wp_enqueue_script( 'nicole-hunn-members-global-js', get_stylesheet_directory_uri() . '/assets/global.js', array(), NHM_VERSION,  true);
	

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );



 error_reporting (-1);
 ini_set('error_reporting', E_ALL);


 include_once NHM_DIR . '/components/index.php';
 include_once NHM_DIR . '/get-icon.php';
 include_once NHM_DIR . '/customfields/customfields.php';
 include_once NHM_DIR . '/inc/index.php';


//archive pages helper
function get_taxonomy_term_title(){
  return get_queried_object()->name;
}
function get_taxonomy_title(){
  $taxonomy_slug = get_queried_object()->taxonomy;
  $taxonomy = get_taxonomy($taxonomy_slug);
  return $taxonomy->labels->singular_name;
}

// remove "Private: " from titles
function remove_private_prefix($title) {
	$title = str_replace('Private: ', '', $title);
	return $title;
}
add_filter('the_title', 'remove_private_prefix');

//Remove Empty Collections from main query.
function remove_empty_collections_from_main_query($query){

	global $post;
	if(
		!is_admin() &&
		$query->is_main_query() &&
		is_post_type_archive('lists')
		){
			$query->set('posts_per_page', 100);
			$query->set( 'meta_query', array(
            array(
                'key'     => 'list_items',
                'compare' => '!=',
								'value'	=> ["", array(), false]
            )
        ) );
			
		}
		return;
}


add_action('pre_get_posts', 'remove_empty_collections_from_main_query');

