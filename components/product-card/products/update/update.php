<?php
add_filter('card_bottom', function($card_bottom_markup, $product){
  if($product->post_type === 'post'){
     ob_start();
    ?>
      <div>
        <?php echo date('F j, Y', strtotime($product->post_date)); ?>
      </div>
      <a href=<?php echo apply_filters('product_card_link', get_the_permalink($product->ID), $product); ?> class="product-title" >
        <h4>
          <?php echo apply_filters('product_card_title', $product->post_title, $product); ?>
        </h4>
      </a>  
    <?php
    $card_bottom_markup = ob_get_clean(); //overwrite completely
  }
  return $card_bottom_markup;
},3,2);