<?php 

function get_logo(){
  ?>
  <a data-part="logo" class="logo-container" href="/dashboard">
    <div class=" logo">
			<div class="desktop-logo">
					<img width="198" height="95" src='<?php echo get_stylesheet_directory_uri() . "/images/Members-white-logo.svg"; ?>'/>
			</div>
			<div class="mobile-logo">
				<img height="61" width="60" src='<?php echo  get_stylesheet_directory_uri(). "/images/Mobile-members-logo-solid.png"; ?>'/>
			</div>
    </div>
    <h1
      class="text-nhRed " style="opacity:0;height:0;width:0;clip-path:0 0 0 0;position:absolute;"
    >members</h1>
  </a>
  <?php
}
function nav_button($name, $icon="bell", $icon_type="regular"){
  ?> 
  <div class="flour-calc-wrapper" id="flour-calc" data-state>
    <!-- svelte component will go here -->
  </div>
  <?php
}

include_once NHM_DIR . "/components/global-sidebar/parts/navigation.php";

