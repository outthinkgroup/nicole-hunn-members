<?php
function post_type_grid($type, $category=['slug'=>null, 'terms'=> null ], $count=-1, $author=null, $options=['post_status'=>"publish"] ){
  $args = [
    'post_type' => $type,
    'posts_per_page' => $count,
    'post_status'=>$options['post_status']
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
      <?php product_card($post); ?>
    </li>
    <?php
  }
  ?> 
  <?php do_action('post_type_grid_append_item', $type, $author, $count); ?>
  
  </ul>
  <?php do_action('post_type_grid_after_loop', $type, $author, $count); ?>
  <?php
}



function wp_loop_post_grid(){
  if ( have_posts() ) : ?> 
  <ul class="grid">
  <?php while ( have_posts() ) : the_post(); 
    global $post;
    ?>
    <li <?php echo apply_filters('post_type_grid_li_attr', '', $post->post_type, $post, $post->post_author); ?> >
      <?php product_card($post); ?>
    </li>
    <?php
  endwhile; 
  ?> 
  </ul>
  <?php else : ?>
 	<p><?php esc_html_e( 'Sorry, no posts matched your criteria.' ); ?></p>
 <?php endif; 
}

include_once NHM_DIR . "/components/post-type-grid/products/products.php";
