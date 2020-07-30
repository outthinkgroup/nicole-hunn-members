<?php
include_once NHM_DIR . "/components/product-card/products/index.php";

function product_card($product, $options=['title_tag'=>'h4']){
  ?>
  <div class="product-card">
    <div class="<?php echo apply_filters("card_top_classes", 'card-top ', $product); ?>">
      <a class="product-image" href="<?php echo get_the_permalink($product->ID); ?>">
        <?php echo apply_filters("product_image", get_the_post_thumbnail($product->ID), $product); ?>
      </a>
      <?php do_action('product_card_top', $product); ?>
    </div>
    <?php $card_bottom_classes = 'card-bottom'; ?>
    <div class="<?php echo apply_filters("card_bottom_classes", $card_bottom_classes, $product); ?>">
      <a href="<?php echo get_the_permalink($product->ID); ?>">
        <?php echo '<' . $options['title_tag'] . ' class="'. apply_filters('product_card_title_classes', 'product-title', $product) .'" >'; ?>
        <?php echo apply_filters('product_title',$product->post_title, $product); ?>
        <?php echo '</' . $options['title_tag'] . '>'; ?>
      </a>
      <?php do_action('product_card_actions', '', $product); ?>
    </div>
  </div>
  <?php
}

