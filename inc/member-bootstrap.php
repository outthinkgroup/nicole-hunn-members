<?php
function enqueue_logged_in_assets(){
	wp_enqueue_style( 'logged-in-styles', get_stylesheet_directory_uri() . '/assets/index.css', array('astra-theme-css', 'nicole-hunn-members-global-css'), NHM_VERSION, 'screen' );
	wp_enqueue_script('flour-calc', get_stylesheet_directory_uri() . '/assets/flour-calc/flour-calc.js', [], NHM_VERSION, true );
	wp_enqueue_script( 'logged-in-scripts', get_stylesheet_directory_uri() . '/assets/index.js', [], NHM_VERSION, true );
	wp_localize_script( 'logged-in-scripts', 'WP', [
		"userId" => get_current_user_id(),
		'ajaxUrl'=> admin_url( 'admin-ajax.php' )
	]);
}

function init_helpscout(){
	?>
		<script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});
		</script><script type="text/javascript">window.Beacon('init', 'e296ca53-aa5d-4c1d-8701-b4aeb669bfe2')</script> 
	<?php
}

function bootstrap_logged_in_ui(){
	//adds sidebar
	add_action('astra_body_top', 'global_sidebar');
	//remove top header
	remove_action('astra_header','astra_header_markup', 999);
	//searchbar
	add_action('astra_header_before', 'util_navigation_and_search');
	//adds logged in css
	add_action( 'wp_enqueue_scripts', 'enqueue_logged_in_assets', 16 );
	//adds help scout
	add_action('wp_head', 'init_helpscout');
}

add_action( 'init', function(){
	if(is_user_logged_in()){
		bootstrap_logged_in_ui( );
	}
});


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

//* Adds the notification functionality
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