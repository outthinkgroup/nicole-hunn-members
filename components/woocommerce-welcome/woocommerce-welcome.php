<?php
function get_woocommerce_welcome(){
  ?>
  <div class="woo-welcome">
    <h2>Thanks! You may now access your member dashboard</h2>
    <a href="/dashboard" class="primary-cta">See Your Dashboard</a>
  </div>
  <?php
}

// add_filter('the_title', function($title){
//   if( is_wc_endpoint_url( 'order-received' ) ){
//     $title = null;
//   }
//   return $title;
// }, 10, 1);