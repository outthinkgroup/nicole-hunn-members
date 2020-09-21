<?php
get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
global $post;
?>

	<div class="member-updates-single-layout ">
    <div class="wrapper">

      <header>
        <h2><?php echo the_title(); ?></h2>
      </header>
      <main class="">
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
	</div>


<?php get_footer(); ?>
