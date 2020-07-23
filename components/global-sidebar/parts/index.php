<?php 

function get_logo(){
  ?>
  <a data-part="logo" class="logo-container" href="/">
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
  <button 
    class="nav-button nav-link"
  >
    <span class="icon">
      <?php get_icon($icon, $icon_type); ?>
    </span>
    <span class="link-text"><?php echo $name; ?></span>
  </button>
  <?php
}

include_once NHM_DIR . "/components/global-sidebar/parts/navigation.php";