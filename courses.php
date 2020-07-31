<?php
/*
* Template Name: Courses
*/
get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>

	<div class="custom-wrapper dashboard">
		<header>
			<h2><?php echo the_title(); ?></h2>
		</header>

		<main class="dashboard">
			<section class="my-courses">
				<ul class="grid" style="--cols:2; --card-mx-width:100%">
					<?php
						$courses = nhm_user_courses($user_id);
						foreach($courses as $course){
							product_card($course);
						}
					?>
				</ul>
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
