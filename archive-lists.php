<?php 
/* 
THIS IS FOR THE COMMUNITY LISTINGS
*/
?>
<?php get_header(); ?>


<div class="custom-wrapper recipe-collections">
  <header>
    
    <h2>Community Collections</h2>
  </header>
  
  <main class="user-collections">
    <div class="recipe-list-management-area">
      <div class="lists">
        <?php wp_loop_post_grid();  ?>
      </div>
    </div>
  </main>

</div>

<?php get_footer(); ?>