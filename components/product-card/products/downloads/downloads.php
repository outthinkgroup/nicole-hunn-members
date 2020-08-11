<?php

function nhm_user_downloads($user_id){
  $downloads = get_posts('post_type=member_content&posts_per_page=3');
	return $downloads;
}

add_filter("product_card_post_type", function($postType, $product){

  $postType = 'member_content';
  return $postType;
},10,2);