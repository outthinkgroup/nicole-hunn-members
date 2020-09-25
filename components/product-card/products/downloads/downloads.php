<?php

function nhm_user_downloads($user_id, $num = 3){
  $downloads = get_posts('post_type=member_content&posts_per_page='.$num);
	return $downloads;
}

//adds the content_type to the card
add_filter('card_bottom', function($card_bottom_markup, $product){
  if($product->post_type !== 'member_content') return $card_bottom_markup;
  $type = get_the_terms($product, 'linked_content')[0];
  ob_start();
  ?>
    <div>
      <a 
      href="/content_type/<?php echo $type->slug;?>" 
      class="tag"
      >
        <?php echo $type->name; ?>
      </a>
    </div>
    <a href=<?php echo apply_filters('product_card_link', get_the_permalink($product->ID), $product); ?> class="product-title" >
      <h4>
        <?php echo apply_filters('product_card_title', $product->post_title, $product); ?>
      </h4>
    </a>  
  <?php
  $card_bottom_markup = ob_get_clean();
  return $card_bottom_markup;
}, 10, 2);