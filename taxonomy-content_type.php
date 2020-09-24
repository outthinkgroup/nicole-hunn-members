<?php
/* this is for the post type member_content and the taxonomy content_type
*/

get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>

<div class="archive-template-layout">
  <header style="--header-bg:url('/wp-content/uploads/2020/01/fresco-pizza-top.jpg');"> 
    <h2>
      <?php echo get_taxonomy_term_title(); ?>
    </h2>
  </header>
  <main class="page-mx-width">
    <section class="my-downloads">
      <?php wp_loop_post_grid(); ?>
    </section>
  </main>
</div>
<?php get_footer(); ?>
