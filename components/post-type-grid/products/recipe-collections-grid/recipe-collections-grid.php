<?php
//grid area
function add_collection_area($type, $author, $count){
  if($type !== 'lists') return;
  if($author !== wp_get_current_user()->ID) return;

  if(function_exists('show_create_list_area')){
    show_create_list_area();
  }
}
add_action('post_type_grid_after_loop', 'add_collection_area', 10, 3);


add_action('post_type_grid_append_item', function($type){
  if($type !== 'lists') return;
  create_empty_list_item();
},10, 2);

add_filter('post_type_grid_ul_classes', function($classes, $type, $author){
  if($type !== 'lists') return;
  $classes .= ' my-lists';
  return $classes;
},10,3);


//li attributes
add_filter('post_type_grid_li_attr', function($li_atts, $type, $post, $author){
  if($type !== 'lists') return;

  $li_atts .= 'class="list-item" data-list-id="'.$post->ID.'" data-state="idle"';
  return $li_atts;
},10,4);

add_action('empty_product_product_card', function($product, $forced_type){
  if($forced_type !== 'lists') return $product;
  $product = new \stdClass;
  $product->post_title = '';
  $product->ID = 0;
  $product->post_type='lists';
  return $product;
}, 10, 2);

function create_empty_list_item(){
  ?>
  <li class="list-item" data-list-id data-state="hidden">
    <?php product_card(null, 'lists'); ?>
  </li>
  <?php
}

function nhm_collection_grid($atts = []){
  $atts = shortcode_atts(array(
      'count' => -1,
  ), $atts, 'nhm_collection_grid' );
  ob_start();
  $user_id = get_current_user_id();
  post_type_grid('lists',null, -1, $user_id);
  return ob_get_clean();
}
add_shortcode('nhm_collection_grid', 'nhm_collection_grid');
