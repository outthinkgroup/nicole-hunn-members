<?php
function enqueue_logged_in_assets(){
	wp_enqueue_style( 'logged-in-styles', get_stylesheet_directory_uri() . '/assets/index.css?hello', array('astra-theme-css', 'nicole-hunn-members-global-css'), CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, 'all' );
	wp_enqueue_script('flour-calc', get_stylesheet_directory_uri() . '/assets/flour-calc/flour-calc.js', [], CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, true );
	wp_enqueue_script( 'logged-in-scripts', get_stylesheet_directory_uri() . '/assets/index.js', [], CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, true );
	wp_localize_script( 'logged-in-scripts', 'WP', [
		"userId" => get_current_user_id(),
		'ajaxUrl'=> admin_url( 'admin-ajax.php' )
	]);
}

function bootstrap_logged_in_ui(){
	//adds sidebar
	add_action('astra_body_top', 'global_sidebar');
	//remove top header
	remove_action('astra_header','astra_header_markup', 999);
	//searchbar
	add_action('astra_header_before', 'util_navigation_and_search');
	//adds logged in css
	add_action( 'wp_enqueue_scripts', 'enqueue_logged_in_assets', 16 );
}

add_action( 'init', function(){
	if(is_user_logged_in()){
		bootstrap_logged_in_ui( );
	}
});