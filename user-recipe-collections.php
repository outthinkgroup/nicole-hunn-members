<?php
/*
* Template Name: User Collections
*/

get_header();

$user_from_url = isset($_GET['user_id']) ? intval($_GET['user_id']) : null;

if($user_from_url){
	$user_id = $user_from_url;
}else{	
	$user = wp_get_current_user();
	$user_id = $user->ID;
}
$allowed_post_statuses = wp_get_current_user()->ID === $user_id ? ['publish', 'private'] : ['publish'];

?>
<div class="custom-wrapper recipe-collections">
		<header>
			<div class="user-name"><?php echo get_user_by('ID', $user_id)->display_name; ?>'s</div>			
			<h2><?php echo the_title(); ?></h2>
		</header>
		
		<main class="user-collections">
      <div class="recipe-list-management-area">
        <div class="lists">
          <?php post_type_grid('lists', null, -1, $user_id, ['post_status'=>$allowed_post_statuses]); ?><!-- gets only recipes for the user  with id of $user_id-->
        </div>
      </div>
		</main>

	</div>
<?php
get_footer();

