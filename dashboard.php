<?php
/*
* Template Name: Dashboard
*/
get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
global $post;
?>

	<div class="custom-wrapper dashboard">
		<header>
			<h2><?php echo the_title(); ?></h2>
		</header>
		<aside class="dash-sidebar">

		</aside>
		<main class="dashboard">
			<!-- 
			//== CAROUSEL 
			 -->
			<?php dashboard_carousel($post->ID); ?>

			<!-- 
			//== RECIPES
			 -->
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

			<!-- 
			//== LIVES
			 -->
			<section class="gf-lives">
				<header><h3><i>LIVES</i> with Nicole Hunn</h3> <div class="actions"><a href="/ask-me-question">Ask Nicole A question</a></div></header>
				<ul class="grid" style="--cols:auto-fit; --card-mx-width:100%; --min-col-width:220px">
				<?php
				$lives = get_posts([
					'post_type' => 'live',
					'posts_per_page' => 3,
					'post_status' => ['publish', 'future'],
				]);
				foreach($lives as $live){ ?>
					
					<li>
						<?php product_card($live); ?>
					</li>
					<?php
				}
				?> 
				</ul>
				<a href="/gfoas-lives" class="viewall">View all Lives &rarr;</a>
			</section>

			<!-- 
			//== COURSES
			 -->
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

			<!-- 
			//== MY COLLECTIONS	
			 -->
			<section class="my-collections recipe-list-management-area">
				<h3>My Recipe Collections</h3>
				<div class="lists">
          <?php post_type_grid('lists', null, 3, $user_id, ['post_status'=>['private','publish']]); ?>
        </div>
				<a href="/collections" class="viewall">View all My Recipe Collections &rarr;</a>
			</section>
			
			<!-- 
			//== DOWNLOADS
			 -->
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
				<a href="/member-content-downloads/" class="viewall">View all My Downloads &rarr;</a>
			</section>

			<!--
			//== MEMBER/Bonus CONTENT 
			-->
			<section class="bonus">
				<h3>Bonus Content & Updates</h3>
				<ul class="grid" style="--cols:4; --card-mx-width:100%">
					<?php 
						$allposts = get_posts();
						foreach($allposts as $thispost){
							product_card($thispost);
						}
					?>
				</ul>
				<a href="/member-updates/" class="viewall">All Updates &rarr;</a>
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
