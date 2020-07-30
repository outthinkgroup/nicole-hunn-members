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
			<section class="recipes">
				<h3>Recipes</h3>
				<ul class="grid" style="--cols:auto-fill; --min-col-width:220px">
					<?php
						$recipes = nhm_all_recipes();
						foreach($recipes as $recipe){
							product_card($recipe);
						}
					?>
				</ul>
				<a href="/recipes" class="viewall">View all Recipes &rarr;</a>
			</section>
			<section class="my-courses">
				<h3>My Courses</h3>
				<ul class="grid" style="--cols:2; --card-mx-width:100%">
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
				<a href="#" class="viewall">View all My Recipe Collections &rarr;</a>
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
				<a href="/my-account/downloads" class="viewall">View all My Downloads &rarr;</a>
			</section>
			<section class="bonus">
				<h3>Bonus Content & Updates</h3>
				<div class="grid" style="--cols:2; --card-mx-width:100%">
					<ul class="list">
					<?php
					$posts = get_posts('post_type=post&posts_per_page=5');
					foreach ($posts as $post){
						post_in_list($post);
					}
					?>
					</ul>
					<div class="help card shadow-md">
						<h4>Need Help?</h4>
						<form action="/" method="post">
							<label for="name">Name</label>
							<input type="text" name="name" id="name" placeholder="Joe Shmoe" />
							<label for="email">Email Address </label>
							<input type="email" name="email" id="email" placeholder="joe@email.com" />
							<label for="message">Messages</label>
							<textarea name="message" id="message" cols="30" rows="5"></textarea>
							<button type="submit">Get Help</button>
						</form>
					</div>
				</div>
			</section>
		</main>
	</div>


<?php get_footer(); ?>

<?php 
function post_in_list($post){
	$title = $post->post_title;
	$date = $post->post_date;
	if(strlen($post->post_excerpt) <= 1){
		$full_excerpt = $post->post_content;
		$excerpt = wp_trim_words($full_excerpt, 25, null);
	}else {
		$excerpt = $post->post_excerpt;
	}
	?>
	<li class="card shadow-md">
		<a href="<?php echo get_the_permalink($post->ID); ?>">
			<h4><?php echo $title; ?></h4>
		</a>
		<p><?php echo $excerpt; ?></p>
	</li>
	<?php
}
