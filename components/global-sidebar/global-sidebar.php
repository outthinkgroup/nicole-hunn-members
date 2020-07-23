<?php

//

function global_sidebar(){
	require_once __DIR__ . "/parts/index.php";
	?>
	<span class="use-tailwind" >
	<div data-part="global-sidebar-container" 
		data-state="on"
		class="global-sidebar shadow-md  <?php if(is_admin_bar_showing()) echo 'admin-bar-space';?>"
  >
		<?php get_logo(); ?>
		<nav class="pt-10">
			<?php nav_link('My Dashboard', '/dashboard', 'home', 'solid'); ?>
			<?php nav_link('Recipes', '/recipes', 'bookmark', 'solid', 'sml' ); ?>
			<?php nav_link('Courses', '/courses', 'video', 'solid'); ?>
		</nav> 
		<div class="bottom-utils">
				<?php nav_button('Flour Calculator', 'calculator', 'solid'); ?>
		</div>
		<div data-part="toggle-sidebar" class="toggle-sidebar">
			<button class="bg-nhBlue-light py-4 px-4 pr-6 rounded-r-full text-xl">
				<?php get_icon('chevron-left', 'solid'); ?>
			</button>
		</div>
	</div>
	</span>
	<?php
}
function enqueue_logged_in_assets(){
	wp_enqueue_style( 'main-styles', get_stylesheet_directory_uri() . '/assets/index.css', array('astra-theme-css'), CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, 'all' );
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