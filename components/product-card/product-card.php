<?php
include_once NHM_DIR . "/components/product-card/products/index.php";

function product_card($product=null, $forced_type=null){
  if(!$product){
    $product = apply_filters('empty_product_product_card', $product, $forced_type);
  }
  ?>
  <div class="product-card post-type-<?php echo apply_filters('product_card_post_type',$product->post_type, $product); ?> ">
    <div class="card-top">
      <?php echo apply_filters('card_top','', $product); ?>
    </div>
    <div class="card-bottom">
      <?php echo apply_filters('card_bottom','',$product); ?>
    </div>
  </div>  
  <?php
}

add_filter('card_top', function($card_top_markup, $product){
  ob_start();
  ?>
    <?php if( get_the_post_thumbnail($product->ID) ) { ?>
      <a class="product-image" href="<?php echo apply_filters('product_card_link', get_the_permalink($product->ID), $product); ?>">
        <?php echo apply_filters("product_image", get_the_post_thumbnail($product->ID), $product); ?>
      </a>
    <?php }else{ 
      echo apply_filters('product_card_no_image', '', $product);
    }
    ?>
  <?php do_action('after_product_card_image', $product); ?>
  <?php
  $card_top_markup = ob_get_clean();
  return $card_top_markup;
}, 1, 2);

add_filter('card_bottom', function($card_bottom_markup, $product){
  ob_start();
  ?>
    <a href=<?php echo apply_filters('product_card_link', get_the_permalink($product->ID), $product); ?> class="product-title" >
      <h4>
        <?php echo apply_filters('product_card_title', $product->post_title, $product); ?>
      </h4>
    </a>  
  <?php
  $card_bottom_markup .= ob_get_clean();
  return $card_bottom_markup;
}, 1, 2);

add_filter('product_card_no_image', function($replaced_image, $product){
  ob_start();
  ?>
  <a 
    href="<?php echo apply_filters('product_card_link', get_the_permalink($product->ID), $product); ?>" 
    class="product-image " 
    style="padding:20%;"
  >
    <img class="default-img" src="/wp-content/uploads/2020/06/gfoaslogo@4x-1.png" alt="logo" />
  </a>
  <?php
  $replaced_image = ob_get_clean();
  return $replaced_image;
}, 2, 2);