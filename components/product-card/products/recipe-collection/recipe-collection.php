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


function loopThroughRecipesForImage_($array, $count, $image ){
  if((!is_array($array)) || count($array) === 0) return null;
  if(isset($array[$count]) && get_the_post_thumbnail($array[$count])){
    $image = get_the_post_thumbnail($array[$count]);
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
function loopThroughRecipesForImage($array, $count, $image){
  if((!is_array($array)) || count($array) === 0) return null;
  foreach($array as $id){
    if(get_the_post_thumbnail($id)){
      $image = get_the_post_thumbnail($id);
      break;
    }
  }
  return $image;
}

add_filter('card_bottom', function($card_bottom_markup, $product){
  if($product->post_type !== 'lists') return $card_bottom_markup;
  $options = ['edit'=> is_archive() ? false : true, 'recipe_link' => true];
  $author = get_user_by('ID',$product->post_author);
  ob_start();
  show_list_title_and_count($product, $options);
  ?>
  <div class="recipe-author">By: <span class="tag tag--light"><?php echo $author->display_name;  ?></span></div>
  <?php
  $title = ob_get_clean();

  return $title;

}, 10, 2);

add_action('after_product_card_image', function($product){
  if($product->post_type !== 'lists' || $product->post_author != wp_get_current_user()->ID){
    return;
  } 
  do_action('qm/debug', $product->post_status);
  ?>
  <div class="list-actions top-right-corner">
    <button type="button" data-action="warn-delete-list" data-tooltip="Delete this list" class="danger icon-button" style="--tool-tip-y-distance:-80px" >
      <span class="icon"><?php get_icon('delete'); ?></span>
    </button>
  </div>
  <div class="list-actions top-left-corner" data-status="<?php echo $product->post_status; ?>"> 
    <?php privacy_toggle($product, ['action'=>'toggle-privacy-mode', 'title'=>'toggle collection privacy settings']); ?>
  </div>
  <?php
}, 10, 1);
function privacy_toggle($post, $options){
  $status = $post->post_status;
  $is_checked = $status == 'publish' ? true : false;

  lock_toggle($is_checked, $options);
}



add_action('product_card_no_image', function($replaced_image, $product){
  if($product->post_type !== 'lists') return $replaced_image;

  $count=0;
  $recipe_ids = get_post_meta($product->ID, 'list_items', true);
  $image = null;
  $image = loopThroughRecipesForImage($recipe_ids, $count, $image );
  if($image){
    $image = '<a class="product-image" href="'. get_permalink($product->ID) .'">'. $image .  '</a>';
    return $image;
  } 

  ob_start();
  ?>
  <a 
    href="/recipes" 
    class="product-image " 
    style="padding:20px;"
  >
    <div class="default_msg_empty_list">
      <p>Add Recipes To Collection</p>
      <div>
        <?php get_icon('plus', 'solid'); ?>
      </div>
    </div>
  </a>
  <?php
  $replaced_image = ob_get_clean();
  return $replaced_image;
}, 10, 2);

add_filter('product_card_extra_classes', function($classes, $product){
  if($product->post_type !== "lists" || !is_search()) return $classes;
  
  $classes .= 'hide-functionality';
  return $classes;
},10, 2);


//Nicole's Collections get special styles
add_filter('product_card_extra_classes', function ($classes, $product) {
  if($product->post_type !== "lists" && $product->post_author !== NICOLE_USER_ID) return;

  $classes.= "nicole-collection";
  return $classes;
}, 10, 2);