<?php

function nhm_user_downloads($user_id){
  $downloads = wc_get_customer_available_downloads($user_id);
	return $downloads;
}

add_filter('product_card_title', function($the_title, $product){
  if(is_array($product) && array_key_exists('download_url', $product)){
    $the_title = $product['product_name'];
  }
  return $the_title;
}, 11, 2);

add_filter("product_card_post_type", function($postType, $product){

  if(is_array($product) && array_key_exists('download_url', $product)){
    $postType = 'download';
  }
  return $postType;
},10,2);

add_filter('product_image', function($image, $product){
  if(is_array($product) && array_key_exists('download_url', $product)){
    $wc_product_id = get_post($product['product_id']);
    $image = get_the_post_thumbnail($wc_product_id);
  }
  return $image;
},10, 2);