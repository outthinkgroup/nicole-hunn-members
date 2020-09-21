<?php
/*
* Template Name: Bonus Updates
*/
get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>

	<div class="custom-wrapper page-mx-width">
		<header>
			<h2><?php echo the_title(); ?></h2>
		</header>
		<aside class="dash-sidebar">

		</aside>
		<main class="">

				<ul class="grid">
				<?php
						$allposts = get_posts();
						foreach($allposts as $thispost){
							product_card($thispost);
						}
					?>
				</ul>

		</main>
	</div>


<?php get_footer(); ?>