<?php
/**
 * nicole hunn members Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nicole hunn members
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION', '1.34df.0' );
define('NHM_DIR', get_stylesheet_directory());
define('NHM_URL', get_stylesheet_directory_uri());
/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	wp_enqueue_style( 'nicole-hunn-members-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, 'all' );
	wp_enqueue_style( 'nicole-hunn-members-global-css', get_stylesheet_directory_uri() . '/assets/global.css?1.22', array('astra-theme-css'), CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, 'all' );
	wp_enqueue_script( 'nicole-hunn-members-global-js', get_stylesheet_directory_uri() . '/assets/global.js', array(), CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION,  true);
	

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );



 error_reporting (-1);
 ini_set('error_reporting', E_ALL);


 include_once NHM_DIR . '/components/index.php';
 include_once NHM_DIR . '/get-icon.php';
 include_once NHM_DIR . '/customfields/customfields.php';
 include_once NHM_DIR . '/inc/index.php';

//TODO: Please move to own file,
//*CODE That allows us to know if we user has seen  new content
add_action('save_post', function($post_ID, $post, $update ){
	if(!get_field('should_notify_users', $post_ID)) return;
	$users = get_users();
	foreach($users as $user){
		$user_id = $user->ID;
		update_user_meta($user_id, 'should_notify_user', 'true');
	}
},10, 3);

function does_user_need_notification($user_id){
	if(get_user_meta($user_id, 'should_notify_user', true)){
		$should_notify_user = get_user_meta($user_id, 'should_notify_user', true);
		return $should_notify_user;
	}else{
		return false;
	}
}

add_action( 'wp_ajax_nhm_clear_notification', function(){
 
  $user_cleared_notification = $_POST['notified'];
  if($user_cleared_notification){
    user_was_notified(get_current_user_id());
    echo 'success';
  }else{
    echo 'user did not clear notification';
  }
  die();
} );

function user_was_notified($user_id){
	return update_user_meta($user_id, 'should_notify_user', 'false');
}
