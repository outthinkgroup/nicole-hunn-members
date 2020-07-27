<?php
/*
* Template Name: Dashboard
*/
get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>

	<div class="custom-wrapper dashboard">
		<header>
			<h2><?php echo the_title(); ?></h2>
		</header>
		<aside class="dash-sidebar">

		</aside>
		<main class="dashboard">
			<section class="my-courses">
				<h3>My Courses</h3>
				<ul class="grid">
					<?php
						$courses = nhm_user_courses($user_id);
						foreach($courses as $course){
							product_card($course);
						}
					?>
				</ul>
			</section>
			<section class="my-collections">
				<h3>My Recipe Collections</h3>
				<ul class="grid">
					<?php 
						$collections = nhm_user_recipe_collections($user_id);
						foreach($collections as $collection){
							product_card($collection);
						}
					?>
				</ul>
			</section>
			<section class="my-downloads">
				<h3>My Downloads</h3>
				<ul class="grid">
					<?php 
						$downloads = nhm_user_downloads($user_id);
						foreach($downloads as $download){
							product_card($download);
						}
					?>
				</ul>
			</section>
		</main>
	</div>


<?php get_footer(); ?>

<?php 
