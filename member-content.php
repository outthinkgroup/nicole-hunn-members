<?php
/*
* Template Name: Member Content Archive
*/
get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>

	<div class="archive-template-layout">
		<header>
			<h2><?php echo the_title(); ?></h2>
		</header>
		
		<main class="page-mx-width">
			<section class="my-downloads">
				<ul class="grid">
					<?php
						$downloads = nhm_user_downloads($user_id, '-1');
						foreach($downloads as $download){
							product_card($download);
						}
					?>
				</ul>
			</section>
		</main>
	</div>


<?php get_footer(); ?>