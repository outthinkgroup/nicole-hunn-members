<?php

get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>

<div class="custom-wrapper archive-template-layout">
  <header style="--header-bg:url('/wp-content/uploads/2020/01/fresco-pizza-top.jpg');">
    <h2><?php echo post_type_archive_title( '', false );?></h2>
  </header>
		
		<main class="recipes">
      <?php recipe_archive_sidebar(); ?>
      <div class="recipe-grids">
        <?php
      $categories = get_terms('recipe_category', array(
        'orderby' => 'count',
        'order' => 'DESC'
      ));
      foreach($categories as $category){
        //var_dump($category);
        $args = array(
          'post_type' => 'recipe',
          //'posts_per_page' => ,
          'tax_query' => array(
            array(
              'taxonomy' => 'recipe_category',
              'field'    => 'slug',
              'terms'    => $category->slug,
            ),
          ),
        );
        query_posts($args);
        ?>
        <section>
          <h3> <?php echo $category->name; ?></h3>
          <?php wp_loop_post_grid('recipe'); ?>
        </section>
        <?php
      }
      wp_reset_postdata(); 
      ?>
    </div> 
    </div>     
    </main>
	</div>


<?php get_footer(); ?>

