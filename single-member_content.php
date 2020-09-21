<?php 
/* 
* Template for Single Member Content
*/

get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
global $post;


?>

<div class="custom-wrapper member_content-single-layout">
  
  <header>
    <div class="wrapper">
      <h2><?php echo the_title(); ?></h2>
      <div>
        <img src="<?php echo NHM_URL . '/images/frill.jpg'?>" alt="">
      </div>  
    </div>
  </header>

  <main >
    
    <div class="">
      <figure>
      <?php echo get_the_post_thumbnail(); ?>
    </figure>
    <div class="downloads">
        <h3>Download</h3>
        <?php get_download_buttons(); ?>
      </div>
    </div>

    <article>
      <?php 
      if ( have_posts() ) : 
          while ( have_posts() ) : the_post(); 
              the_content();
          endwhile; 
      else: 
          _e( 'Sorry, no pages matched your criteria.', 'textdomain' ); 
      endif; 
      ?>

    </article>
  </main>
</div>

<?php get_footer(); ?>


