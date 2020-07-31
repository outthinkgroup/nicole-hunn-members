<?php
function nhm_all_recipes(){
  $args = [
    'post_type' => 'recipe',
    'posts_per_page' => 4,
  ];
  $recipes = get_posts($args);
  return $recipes;
}
add_action( 'after_product_card_image', function($product){
  if($product->post_type !== 'recipe') return;
  ?>
    <span class="top-left-corner">
      <?php echo do_shortcode('[add_recipe_button icon_button=true post_id='.$product->ID.']'); ?>
    </span> 
  <?php 
},10,1);

include_once NHM_DIR . "/components/product-card/products/recipes/collection-single-recipes.php";