<?php

get_header();
?>
<div class="custom-wrapper archive-template-layout">
  <header style="--header-bg:url('/wp-content/uploads/2020/01/fresco-pizza-top.jpg');">
    <h2>Search</h2>
  </header>
		
		<main class="page-mx-width">
      <div class="recipe-grids">
        <?php
      // $categories = get_terms('recipe_category', array(
      //   'orderby' => 'count',
      //   'order' => 'DESC'
      // ));
      // $category_cache = [];
      // foreach($categories as $category){
      //   //var_dump($category);
      //   $args = array(
      //     'post_type' => 'recipe',
      //     //'posts_per_page' => ,
      //     'tax_query' => array(
      //       'relation'  => 'AND',
      //       array(
      //         'taxonomy' => 'recipe_category',
      //         'field'    => 'slug',
      //         'terms'    => $category->slug,
      //       ),
      //       array(
      //         'operator'  => 'NOT IN',
      //         'taxonomy' => 'recipe_category',
      //         'field'    => 'slug',
      //         'terms'    => $category_cache,
      //       )
      //     ),
      //   );
        // $query = query_posts($args);
        // if( have_posts()){
          ?>
          <section>
            <!-- <h3> <?php echo $category->name; ?></h3> -->
            <?php wp_loop_post_grid(); ?>
          </section>
          <?php
          // $category_cache[] = $category->slug;
        // }
      // }
      // wp_reset_postdata(); 
      ?>
    </div> 
    </div>     
  </main>
</div>


<?php
 get_footer();