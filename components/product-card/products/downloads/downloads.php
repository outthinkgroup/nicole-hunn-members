<?php

function nhm_user_downloads($user_id){
  $downloads = wc_get_customer_available_downloads($user_id);
	return $downloads;
}
add_filter('product_title', function($the_title, $product){
  if(is_array($product) && array_key_exists('download_url', $product)){
    $the_title = $product['product_name'];
  }
  return $the_title;
}, 11, 2);

add_filter("card_top_classes", function($classes, $product){
  if(is_array($product) && array_key_exists('download_url', $product)){
    $classes .= ' card-top--download';
  }
  return $classes;
},10,2);

add_filter('product_image', function($image, $product){
  if(is_array($product) && array_key_exists('download_url', $product)){
    $wc_product_id = get_post($product['product_id']);
    $image = get_the_post_thumbnail($wc_product_id);
  }
  return $image;
},10, 2);