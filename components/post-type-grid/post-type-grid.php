<?php
function post_type_grid($type, $category=['slug'=>null, 'terms'=> null ], $count=-1, $author=null, ){
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
  ?> <ul class="grid"> <?php
  foreach($posts as $post){
    product_card($post);
  }
  ?> </ul> <?php
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

