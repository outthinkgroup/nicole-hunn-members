<?php
global $wp;
get_header();
$user = wp_get_current_user();
$user_id = $user->ID;

$cats_per_page = 5
?>

<div class="custom-wrapper archive-template-layout">
  <header style="--header-bg:url('/wp-content/uploads/2020/01/fresco-pizza-top.jpg');">
    <h2>Recipe Categories</h2>
  </header>
		
		<main class="recipes">
      <?php recipe_archive_sidebar(); ?>
      <div class="recipe-grids">
        <?php
      $query_vars = $wp->query_vars;

      $page = array_key_exists('category-pagination', $query_vars) ? intval($query_vars['category-pagination']) : 0;
      $page = $page >= 1 ? $page - 1 : $page;

      $categories = get_terms('recipe_category', array(
        'orderby' => 'count',
        'order' => 'DESC',
        'number' => $cats_per_page,
        'offset' => $page * $cats_per_page 
      ));
      
      $category_cache = [];
      foreach($categories as $category){
        //var_dump($category);
        $args = array(
          'post_type' => 'recipe',
          'posts_per_page' => 9,
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
            <header>
              <h3> <?php echo $category->name; ?></h3>
              <a class="viewall" href="<?php echo get_term_link($category); ?>">View all <?php echo $category->name; ?> &rarr;</a>
            </header>
            <?php wp_loop_post_grid('recipe'); ?>
            <a class="viewall" href="<?php echo get_term_link($category); ?>" style="margin-top:1.5em">View all <?php echo $category->name; ?> recipes &rarr;</a>

          </section>
          <?php
          $category_cache[] = $category->slug; //this adds the category to the cache so no posts with this category will be shown again
          wp_reset_postdata(); 
        }
      }
      ?>
    </div> 
    </div>     
    </main>
    <?php recipe_category_pagination($page) ?>
	</div>


<?php get_footer(); ?>
