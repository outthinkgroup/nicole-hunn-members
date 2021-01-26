<?php 
/* 
* Template for Single Recipe Collection
*/

get_header();
$user = wp_get_current_user();
$user_id = $user->ID;

global $post;
$author_id = $post->post_author;
$author = get_user_by('ID', $author_id);

$is_owner = $author_id == $user_id;
?>

	<div class="custom-wrapper recipe-collections-single-layout">
		<header class="list-single" data-list-id="<?php echo $post->ID; ?>" data-state="idle" data-status="<?php echo $post->post_status; ?>">
			<div class="user-name"><?php echo $author->display_name; ?></div>
			<div class="flex flex-start">
				<h2><?php echo the_title(); ?></h2>
				<?php if($user_id == $author_id) privacy_toggle($post, ['action'=>'toggle-privacy-mode', 'title'=>'toggle collection privacy settings']); ?>
			</div>
			<div class="list-meta">
				<div class="collection-count">
					<div class="label">
						Number of Recipes
					</div>
					<?php 
					if(function_exists("show_count")){?>
						<div class="tag circle">
							<?php show_count($post->ID); ?>
						</div>
					<?php }
					?>
				</div>
				<div class="collection-privacy">
					<div class="label">This Collection is</div>
					<div class="tag">
						<?php echo $post->post_status == "publish" ? "public": $post->post_status; ?>
					</div>
				</div>
				<div class="share-list-wrapper">
					<div class="label">
						Show others
					</div>
					<button class="circle-button" style="font-size:20px;">
						<span class="icon">
							<?php get_icon('share-alt', 'solid'); ?>
						</span>
					</button>
				</div>
				//TODO add bang to this conditional
				<?php if($is_owner): ?>
				<div class="fork-list-wrapper">
					<div class="label">
						Copy Collection to Your Collections
					</div>

				</div>
				<?php endif; ?>
			</div>
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


