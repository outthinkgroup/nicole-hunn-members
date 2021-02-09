<?php
add_action('after_product_card_image', function($product){
  global $post;
  if($product->post_type !== 'recipe' || $post->post_type !== 'lists' || $post->post_author != wp_get_current_user()->ID) return;
  ?>
  <div class="list-actions top-right-corner">
    <button 
      type="button" 
      data-action="delete-from-list" 
      data-recipe-id="<?php echo $product->ID; ?>" 
      data-list-id="<?php echo $post->ID; ?>"
      data-tooltip="Delete from list" 
      class="danger icon-button" 
      style="--tool-tip-y-distance:-80px" 
    >
      <span class="icon"><?php get_icon('delete'); ?></span>
    </button>
  </div>
  <?php
}, 10, 3);