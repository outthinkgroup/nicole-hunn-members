<?php

function dashboard_carousel($post_id){

  ?>
  <div class="carousel-wrapper">
    <h3>New Content</h3>

    <?php 
    $slides = get_field('slides');
    if($slides) {
    ?>
    <ul class="dashboard-carousel">
    <?php foreach($slides as $slide): ?>
      <li class="slide">
        <div class="content">
          <h4 class="title"><?php echo $slide['title']?></h4>
          <p class="description"><?php echo $slide['description'] ?></p>
          <a href="<?php echo get_permalink($slide['supporting_post']->ID); ?>" class="btn">learn more</a>
        </div>
        <div class="image">

          <?php 
          $image = wp_get_attachment_image( $slide['image'], 'full' );
          if(!$image){
            $image = get_the_post_thumbnail($slide['supporting_post']->ID, 'full');
          }
          echo $image;
          ?>
          <!-- <img src="" alt=""> -->
        </div>
      </li>
    <?php endforeach; ?>  
    </ul>
    
    <div class="navigation">
        <?php 
        for($i=0; $i < count($slides); $i++){
        ?>
          <button class="dot"><span></span></button>  
        <?php
        }
        ?>
    </div>
    <?php } ?>
  </div>
  <?php
}