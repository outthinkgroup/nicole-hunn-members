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
      <?php wp_loop_post_grid('recipe'); ?>
    </main>
    <aside class="recipe-categories">
        <h3>Recipe Categories</h3>
        <ul>
        <?php
          $categories = get_terms('recipe_category');
          foreach($categories as $category){
            ?>
            <li>
              <a class="shadow-sm card" href="<?php echo get_term_link($category); ?>" > <?php echo $category->name; ?></a>
            </li>
            <?php
          }
        ?>
        </ul>
    </aside>
	</div>


<?php get_footer(); ?>

<?php
function get_taxonomy_term_title(){
  return get_queried_object()->name;
}
function get_taxonomy_title(){
  $taxonomy_slug = get_queried_object()->taxonomy;
  $taxonomy = get_taxonomy($taxonomy_slug);
  return $taxonomy->labels->singular_name;
}