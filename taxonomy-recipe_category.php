<?php

get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>

	<div class="custom-wrapper archive-template-layout">
		<header style="--header-bg:url('/wp-content/uploads/2020/01/fresco-pizza-top.jpg');"> 
      <h2>
        <span class="taxonomy">
          <?php echo get_taxonomy_title() . ': ' ; ?>
        </span>
        <?php echo get_taxonomy_term_title(); ?>
      </h2>
    </header>
		
		<main class="recipes">
      <?php recipe_archive_sidebar(); ?>
      <div class="recipe-grid">
        <?php wp_loop_post_grid('recipe'); ?>
      </div>
    </main>
	</div>


<?php get_footer(); ?>

<?php
