<?php

//

require_once __DIR__ . "/parts/index.php";
function global_sidebar(){
	?>
	<div data-part="global-sidebar-container" 
		class="global-sidebar shadow-md  <?php if(is_admin_bar_showing()) echo 'admin-bar-space';?>"
  >
		<?php get_logo(); ?>
		<?php get_sidebar_nav(); ?>
		<div class="bottom-utils">
				<?php nav_button('Flour Calculator', 'calculator', 'solid'); ?>
		</div>
		<div data-part="toggle-sidebar" class="toggle-sidebar">
			<button class="">
				<?php get_icon('chevron-left', 'solid'); ?>
			</button>
		</div>
	</div>
	<?php
}
function enqueue_logged_in_assets(){
	wp_enqueue_style( 'logged-in-styles', get_stylesheet_directory_uri() . '/assets/index.css', array('astra-theme-css'), CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, 'all' );
	wp_enqueue_script( 'logged-in-scripts', get_stylesheet_directory_uri() . '/assets/index.js', [], CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, true );
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