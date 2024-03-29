<?php

function dashboard_carousel($post_id){
  $slides = get_field('slides');
  if($slides) { ?>
  <div class="carousel-wrapper">
    <ul class="dashboard-carousel">
    <?php foreach($slides as $slide): ?>
      <li class="slide">
        <div class="content">
          <h4 class="title"><?php echo $slide['title']?></h4>
          <p class="description"><?php echo $slide['description'] ?></p>
          <?php if(array_key_exists('supporting_post', $slide) && $slide['supporting_post']){
              $link = get_permalink($slide['supporting_post']->ID);
            }elseif(array_key_exists('custom_link', $slide) && $slide['custom_link']) {
              $link = $slide['custom_link'];
            }
            ?>
          <a href="<?php echo $link; ?>" class="btn">
            
            <?php if(array_key_exists('button_text', $slide) && $slide['button_text']){
              echo $slide['button_text'];
            }else {
              echo 'Learn More';
            }
            ?>
          </a>
        </div>
        <div class="image">
          <?php 
          $image = wp_get_attachment_image( $slide['image'], 'full' );
          if(!$image){
            $image = get_the_post_thumbnail($slide['supporting_post']->ID, 'full');
          }
          echo $image;
          ?>
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
  </div>
  <?php }

}