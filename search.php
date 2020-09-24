<?php
global $wp_query;
get_header();
?>
<div class="archive-template-layout">
  <header style="--header-bg:url('/wp-content/uploads/2020/01/fresco-pizza-top.jpg'); padding:50px;">
    <h2>
      Searched for: <?php echo get_search_query() ?>
    </h2>
  </header>
		
		<main class="page-mx-width">
      <div class="recipe-grids">
        <?php
          $searched_posts = $wp_query->posts;
          $post_type_group = [];
          foreach($searched_posts as $s_post){
            $post_type = get_post_type_object($s_post->post_type);
            $post_type_group[$post_type->label][] = $s_post;
          }
          foreach($post_type_group as $post_type=>$posts){
          ?>
          <section class="post-collection">
            <h3> <?php echo $post_type; ?></h3>
            <ul class="grid">

              <?php
            foreach($posts as $_post){ ?>
              
                <?php product_card($_post);?>
              
              <?php } ?>
            </ul>
          </section>
          <?php
            
          }
          
      ?>
    </div> 
    </div>     
  </main>
</div>


<?php
get_footer();

/* 
create list of all post types
loop through post types 
  loop through all the post and if is same post type
  show that post
  remove post from array

create an array of arrays of post types and put each post in to corresponding key
create parent array
loop through all posts
push post into array[post_type][] = post

*/