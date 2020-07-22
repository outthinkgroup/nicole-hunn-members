<?php 

function get_logo(){
  ?>
  <a class="h-16 mb-4 w-full bg-blue-900 flex py-2 px-10 items-center" href="/">
    <div class="w-16 mr-6  h-full flex items-center">
      <img 
        class="max-w-full h-auto" 
        src="/wp-content/uploads/2020/06/gfoaslogo@4x-1.png" alt="logo"
      >
    </div>
    <h1
      class="text-nhRed font-medium text-2xl leading-none mb-3 "
    >members</h1>
  </a>
  <?php
}

function nav_link($name, $link, $icon="bell", $icon_type="regular"){
  ?> 
  <a 
    href="<?php echo $link; ?>"
    class="flex text-white hover:text-blue-200 py-2 px-10 hover:bg-blue-900 items-center"
  >
    <span class="w-6 px-1  fill-current inline-block mr-2">
      <?php get_icon($icon, $icon_type); ?>
    </span>
    <span><?php echo $name; ?></span>
  </a>
  <?php
}
function nav_button($name, $icon="bell", $icon_type="regular"){
  ?> 
  <button 
    class="flex text-white py-2 px-10 hover:bg-blue-900 items-center"
  >
    <span class="w-6 px-1  fill-current inline-block mr-2">
      <?php get_icon($icon, $icon_type); ?>
    </span>
    <span><?php echo $name; ?></span>
  </button>
  <?php
}