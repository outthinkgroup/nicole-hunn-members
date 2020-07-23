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

function nav_link($name, $link, $icon="bell", $icon_type="regular", $size='md'){
  
  ?> 
  <a 
    data-part="nav-link"
    href="<?php echo $link; ?>"
    class="nav-link"
  >
    <span class="icon">
      <?php get_icon($icon, $icon_type); ?>
    </span>
    <span class="link-text"><?php echo $name; ?></span>
  </a>
  <?php
}
function nav_button($name, $icon="bell", $icon_type="regular"){
  ?> 
  <button 
    class="nav-button"
  >
    <span class="icon">
      <?php get_icon($icon, $icon_type); ?>
    </span>
    <span><?php echo $name; ?></span>
  </button>
  <?php
}