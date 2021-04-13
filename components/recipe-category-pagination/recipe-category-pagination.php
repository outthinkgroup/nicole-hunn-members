<?php
function recipe_category_pagination($current_page_offset, $per_page = 5, $link_count=5){
   $current_page = $current_page_offset + 1;
  //get total categories
  $total_categories = wp_count_terms('recipe_category');
  //get total category pages
  $total_pages = floor($total_categories / $per_page);
  // is first
  $is_first = $current_page_offset <= 0;
  // is last
  $is_last = $current_page >= $total_pages;
  //get first
  $first_page_url = get_cat_url(0);
  // get last
  $last_page_url= get_cat_url($total_pages);
  //get next
  $current_page_url=get_cat_url($current_page);
  $next_page_url=get_cat_url($current_page + 1);
  $prev_page_url=get_cat_url($current_page - 1);
  do_action('qm/debug', $total_pages );
  //render()
  ?>
  <div class="nhm-pagination">
    <?php if(!$is_first):?> <a href="<?php echo $prev_page_url;?>">&larr; previous</a> <?php endif; ?>
      <div class="inner">
        <a href="<?php echo $current_page_url;?>" class="current"><?php echo $current_page?></a>
      
      <?php for($i = 1; $i<=$link_count; $i++ ):
      $p = $current_page + $i;
      ?>
      
        <?php if($p < $total_pages): ?> <a href="<?php echo get_cat_url($p); ?>" ><?php echo $p ?></a><?php endif; ?>
        
      <?php endfor; ?>  
    </div>
        
      <?php if(!$is_last): ?> <a href="<?php echo $next_page_url;?>">next &rarr;</a> <?php endif; ?>
    </div>
  <?php
}

function get_cat_url($page){
  return "/recipe-categories/$page/";
}