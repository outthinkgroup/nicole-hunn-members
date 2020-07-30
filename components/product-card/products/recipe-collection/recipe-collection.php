<?php



function nhm_user_recipe_collections($user_id){
  $listArgs = array(
    'post_type' => 'lists',
    'author' => $user_id,
    'posts_per_page' => '3'
  );
  $lists = get_posts($listArgs);
  return $lists;
}

add_filter('product_image', function($image, $product){
  if($product->post_type == 'lists'){
    $count=0;
    $recipe_ids = get_post_meta($product->ID, 'list_items', true);
    
    $image = loopThroughRecipesForImage($recipe_ids, $count, $image );

  }
  return $image;
},10,2);
function loopThroughRecipesForImage($array, $count, $image ){
  if($image = get_the_post_thumbnail($array[$count])){
      // var_dump($image);
      echo $image;
      return;
    }else{
      $count++;
      if($array[$count]){
        loopThroughRecipesForImage($array, $count, $image);
      }else{
        // var_dump([$array, $count]);
        return null;
      }
    }
}

add_filter('product_card_complex_title', function($title, $product){
  if(!$product->post_type === 'lists') return $title;

  ob_start();
  show_list_title_and_count($product);
  $title = ob_get_clean();

  return $title;

}, 10, 2);

add_action('product_card_top', function($product){
  ?>
  <div class="list-actions top-right-corner">
    <button type="button" data-action="delete-list" data-tooltip="Delete this list" class="danger icon-button" style="--tool-tip-y-distance:-80px" >
      <span class="icon"><?php get_icon('delete'); ?></span>
    </button>
  </div>
  <?php
}, 10, 1);

