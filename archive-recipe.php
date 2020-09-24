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
      $category_cache = [];
      foreach($categories as $category){
        //var_dump($category);
        $args = array(
          'post_type' => 'recipe',
          //'posts_per_page' => ,
          'tax_query' => array(
            'relation'  => 'AND',
            array(
              'taxonomy' => 'recipe_category',
              'field'    => 'slug',
              'terms'    => $category->slug,
            ),
            array(
              'operator'  => 'NOT IN',
              'taxonomy' => 'recipe_category',
              'field'    => 'slug',
              'terms'    => $category_cache,
            )
          ),
        );
        $query = query_posts($args);
        if( have_posts()){
          ?>
          <section class="post-collection">
            <h3> <?php echo $category->name; ?></h3>
            <?php wp_loop_post_grid('recipe'); ?>
          </section>
          <?php
          $category_cache[] = $category->slug;
        }
      }
      wp_reset_postdata(); 
      ?>
    </div> 
    </div>     
    </main>
	</div>


<?php get_footer(); ?>

<!-- 
# Ideas
- create a cache of already displayed recipes.
before running wp_loop_post_grid run a array_filter 
for posts in the cache to weed out the already dsiplayed

- create a cache of already displayed categories.
In the args query for query_posts include an
exclude param for the posts in the already display categories



 -->