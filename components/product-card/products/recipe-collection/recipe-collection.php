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
      
    
    // var_dump($first_recipe_id);
    // $image = $first_recipe_id;
  }
  return $image;
},10,2);
function loopThroughRecipesForImage($array, $count, $image ){
  if($image = get_the_post_thumbnail($array[$count])){
      return $image;
    }else{
      $count++;
      if($array[$count]){
        loopThroughRecipesForImage($array, $count, $image);
      }else{
        return null;
      }
    }
}

