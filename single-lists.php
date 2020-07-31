<?php 
/* 
* Template for Single Recipe Collection
*/

get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
global $post;
?>

	<div class="custom-wrapper recipe-collections-single-layout">
		<header>
			<h2><?php echo the_title(); ?></h2>
		</header>
		<main class="lists-single">
			<section class="">
				<ul class="grid" style="--cols:3; --card-mx-width:100%">
          <?php
          if(function_exists('get_list_items')) {
            $recipes = get_list_items( $post->ID );

            if(is_array($recipes)){
              foreach($recipes as $recipe_id){
                $recipe = get_post($recipe_id);
                product_card($recipe);
              }
            }
          }
					?>
				</ul>
			</section>
		</main>
	</div>


<?php get_footer(); ?>


