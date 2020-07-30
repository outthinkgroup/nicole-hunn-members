<?php
/*
* Template Name: User Collections
*/
get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>
<div class="custom-wrapper dashboard">
		<header>
			<h2><?php echo the_title(); ?></h2>
		</header>
		
		<main class="user-collections">
      <?php post_type_grid('lists',null, -1, $user_id); ?>

		</main>
	</div>

<?php

function nhm_collection_grid($atts = []){
  $atts = shortcode_atts(array(
      'count' => -1,
  ), $atts, 'nhm_collection_grid' );
  ob_start();
  $user_id = get_current_user_id();
  post_type_grid('lists',null, -1, $user_id);
  return ob_get_clean();
}
add_shortcode('nhm_collection_grid', 'nhm_collection_grid');