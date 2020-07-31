<?php
/*
* Template Name: User Collections
*/

get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>
<div class="custom-wrapper recipe-collections">
		<header>
			<h2><?php echo the_title(); ?></h2>
		</header>
		
		<main class="user-collections">
      <div class="recipe-list-management-area">
        <div class="lists">
          <?php post_type_grid('lists',null, -1, $user_id, true); ?>
        </div>
      </div>
		</main>
	</div>
<?php

