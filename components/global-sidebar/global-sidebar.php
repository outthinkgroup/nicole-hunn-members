<?php

//

require_once __DIR__ . "/parts/index.php";
function global_sidebar(){
	?>
	<div data-part="global-sidebar-container" 
		class="global-sidebar shadow-md  <?php if(is_admin_bar_showing()) echo 'admin-bar-space';?>"
  >
		<?php get_logo(); ?>
		<?php get_sidebar_nav(); ?>
		<div class="bottom-utils" style="">
				<?php nav_button('Flour Calculator', 'calculator', 'solid'); ?>
		</div>
		<div data-part="toggle-sidebar" class="toggle-sidebar"  style="">
			<button class="">
				<?php get_icon('chevron-left', 'solid'); ?>
			</button>
		</div>
	</div>
	<?php
}
