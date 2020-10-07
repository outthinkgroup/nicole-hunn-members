<?php

add_shortcode('laptop_mockup', function($atts){
  $param = shortcode_atts( array(
		'mockup-url' => '/wp-content/uploads/2020/10/laptop_mockup-1.png',
    'price' => '29.97',
  ), $atts );
  $image_url = $param['mockup-url'];
  $price = $param['price'];

  ob_start(); ?>
  <div class="mockup-wrapper">
    <div class="mockup">
      <div class="shadow-wrapper"><div class="banner-shadow"></div></div>
      <div class="mockup-image">
        <img src="<?php echo $image_url; ?>" alt="screen shot of course"/>
      </div>
      <div class="mockup-price-wrapper">
        <div class="mockup-price">
          <span class="currency"><span class="symbol">$</span><span><?php echo $price; ?></span></span> <span class="desc">Value</span></div>
      </div>
    </div>
  </div>
  <?php
  return ob_get_clean();
});
