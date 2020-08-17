<?php
include_once NHM_DIR . "/components/product-card/products/recipes/collection-single-recipes.php";

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

add_filter('card_bottom', function($card_bottom_markup, $product){
  if($product->post_type !== 'recipe') return $card_bottom_markup;

  ob_start();
  ?><ul class="cat-list"><?php
    $categories = get_the_terms($product->ID, 'recipe_category');
    foreach($categories as $category){
      ?>
      <li>
        <a href="<?php echo '/'.$category->taxonomy.'/'.$category->slug; ?>">
          <?php echo $category->name ?>
        </a>
      </li>
      <?php
    }
  ?> </ul> <?php 
  $card_bottom_markup .= ob_get_clean();
  return $card_bottom_markup;
}, 10, 2);