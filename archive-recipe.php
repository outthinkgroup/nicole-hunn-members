<?php

get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>

<div class="custom-wrapper archive-template-layout">
  <header style="--header-bg:url('/wp-content/uploads/2019/11/Peanut-Butter-Blossom-Cookies-overhead.png');">
    <h2><?php echo post_type_archive_title( '', false );?></h2>
  </header>
		
		<main class="recipes">
      <?php wp_loop_post_grid('recipe'); ?>
    </main>
    <aside class="recipe-categories">
        <h3>Recipe Categories</h3>
        <ul>
        <?php
          $categories = get_terms('recipe_category');
          foreach($categories as $category){
            ?>
            <li >
              <a class="shadow-sm card" href="<?php echo get_term_link($category); ?>" > <?php echo $category->name; ?></a>
            </li>
            <?php
          }
        ?>
        </ul>
    </aside>
	</div>


<?php get_footer(); ?>

