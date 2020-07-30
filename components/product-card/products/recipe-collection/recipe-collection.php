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

