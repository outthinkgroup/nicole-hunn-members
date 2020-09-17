<?php 

function get_logo(){
  ?>
  <a data-part="logo" class="logo-container" href="/dashboard">
    <div class=" logo">
      <img 
        class="" 
        src="/wp-content/uploads/2020/06/gfoaslogo@4x-1.png" alt="logo"
      >
    </div>
    <h1
      class="text-nhRed "
    >members</h1>
  </a>
  <?php
}
function nav_button($name, $icon="bell", $icon_type="regular"){
  ?> 
  <div class="flour-calc-wrapper" id="flour-calc" data-state>
    
  </div>
  <?php
}

include_once NHM_DIR . "/components/global-sidebar/parts/navigation.php";

