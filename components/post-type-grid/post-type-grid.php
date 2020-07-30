<?php
function post_type_grid($type, $category=['slug'=>null, 'terms'=> null ], $count=-1, $author=null, $product_complex_title=false ){
  $args = [
    'post_type' => $type,
    'posts_per_page' => $count,
  ];
  if($category && $category['slug'] = $cat){
    $terms = $category['terms'];
    $args['tax_query'] = [
      [
        'taxonomy' => $cat,
        'field' => 'slug',
        'terms' => $terms,
        'operator' => 'IN',
      ]
    ];
  }
  if($author){
    $args['author'] = $author;
  }

  $posts = get_posts($args);
  ?> <ul class="<?php echo apply_filters('post_type_grid_ul_classes', 'grid', $type, $author); ?>"> <?php
  foreach($posts as $post){
    ?>
    <li <?php echo apply_filters('post_type_grid_li_attr', '', $type, $post, $author); ?> >
      <?php product_card($post, null, $product_complex_title); ?>
    </li>
    <?php
  }

  do_action('post_type_grid_after_loop', $type, $author, $count);
  ?> 
  </ul> 
  <?php
}



function wp_loop_post_grid(){
  if ( have_posts() ) : ?> 
  <ul class="grid">
  <?php while ( have_posts() ) : the_post(); 
    global $post;
    product_card($post); 
  endwhile; 
  ?> 
  </ul>
  <?php else : ?>
 	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
 <?php endif; 
}

include_once NHM_DIR . "/components/post-type-grid/products/products.php";
