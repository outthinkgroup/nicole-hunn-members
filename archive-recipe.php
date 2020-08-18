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
      <aside class="recipe-categories">
        <div>

        
        <div class="filter-widget">
          Filter
          <div class="search-wrapper">
            <form class="search-bar shadow-sm" action="/" method="GET" data-action="filter">
              <input 
                placeholder="Filter"
                type="search"
                name="s"
                value="<?php echo get_search_query() ?>"
                id="s"
              />
              <button type="submit" >
                <span >
                  <?php get_icon('search', 'solid'); ?>
                </span>
              </button>
            </form>
          </div>
        </div>

        <div class="filter-widget">
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
        </div>
      </aside>
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

