<?php
function nhm_all_recipes(){
  $args = [
    'post_type' => 'recipe',
    'posts_per_page' => 4,
  ];
  $recipes = get_posts($args);
  return $recipes;
}
add_action( 'product_card_top', function($product){
  if($product->post_type !== 'recipe') return;
  ?>
    <span class="top-left-corner">
      <?php echo do_shortcode('[add_recipe_button icon_button=true]'); ?>
    </span> 
  <?php 
},10,1);