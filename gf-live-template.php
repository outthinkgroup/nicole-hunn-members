<?php
/* template name: GF Live */
get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
global $post;
?>

	<div class="nhm-default ">
    <div class="wrapper wrapper--live">
      <header>
        <div class="pre-heading"><?php echo the_title(); ?></div>
        <h2><?php echo get_field('topic'); ?></h2>

      </header>
      <main class="">
        <article>
        <div class="iframe-wrapper">
          <? echo get_field('live_video');?>
        </div>
        <div>
        <?php 
        if ( have_posts() ) : 
          while ( have_posts() ) : the_post(); 
            the_content();
          endwhile; 
        else: 
          _e( 'Sorry, no pages matched your criteria.', 'textdomain' ); 
        endif; 
        ?>
        </div>
        </article>
      </main>
    </div>
	</div>


<?php get_footer(); ?>
