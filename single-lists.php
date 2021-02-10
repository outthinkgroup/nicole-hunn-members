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

$get_status =  $post->post_status == "publish" ? "public": $post->post_status;
$get_next_status = $post->post_status != "publish" ? "public": $post->post_status;

?>
	<div class="custom-wrapper recipe-collections-single-layout">
		<header class="list-single " data-list-id="<?php echo $post->ID; ?>" data-state="idle" data-status="<?php echo $post->post_status; ?>">
			<div class="flex flex-start title-el">
				<h2 class="flex flex-start">
				<span><?php echo the_title(); ?></span>
				<?php if ($is_owner): ?>
				<button class="circle-button " data-tooltip="Rename List" data-action="rename-list">
					<span class="icon"><?php get_icon('edit'); ?></span>
				</button>
				<?php endif; ?>
				</h2>
			</div>

			<div class="list-meta">
				<!--  -->
				<div class="byline">
					<div class="tag" >
						By: <span class="user-name"><?php echo $author->display_name; ?></span>
					</div>
				</div>
				<!--  -->
				<div class="collection-count">
					<?php 
					if(function_exists("show_count")){?>
						<div class="tag" data-tooltip="Number of Recipes">
							<span class="bold-label" style="margin-top:-7px; margin-right:8px;"><?php show_count($post->ID); ?></span>
							Recipes
						</div>
					<?php }
					?>
				</div>
				<!--  -->
				<div class="collection-privacy">
					<div class="tag" data-tooltip="Click lock to change privacy">
							<?php if($user_id == $author_id) privacy_toggle($post, ['action'=>'toggle-privacy-mode', 'title'=>'toggle collection privacy settings']); ?>
							<span class="status label"><?php echo $get_status; ?></span>
					</div>
				</div>
				<!--  -->		
				<div class="fork-list-wrapper">
					<div class="tag" data-tooltip="Copy Collection">
						<button class="circle-button" style="font-size:20px; margin-right:8px;" data-action="fork-list">
						<span class="icon">
							<?php get_icon('clone', 'solid'); ?>
						</span>
					</button>
					Copy
					</div>
				</div>
				<!--  -->		
			</div><!-- end of list meta -->

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


