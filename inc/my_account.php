<?php

add_filter ( 'woocommerce_account_menu_items', 'arrange_menu_items', 999, 1 );
 
function arrange_menu_items( $menu_links ){
	//unset all unnecessary items
	unset($menu_links['downloads']);

	//edit labels
	// $menu_links['dashboard'] = 'Overview';
	// $menu_links['subscription'] = 'Subscription Details';
	

	//rearrange
	$new_order = array(
		'edit-account'=> 'My Account',
		'subscriptions'=> 'Subscription',
		'payment-methods'=> 'Payment Methods',
		'orders'=> "Past Orders",
		'edit-address'=> 'My Address',
		'customer-logout'=> "Logout"
	);

	return $new_order;
}


/*
- dashboard -> Overview
- account details
- subscriptions -> subscription details
- memberships -> membership
- downloads
- payment methods
- orders
- addresses
- log out
*/



add_action('wp', function(){
	if(!is_wc_endpoint_url() && is_account_page()){
		wp_redirect(site_url() . '/my-account/edit-account');	
	}
});

//add_action('init', 'create_subscrption_redirect_endpoint');

// create cusom endpoint
add_action('template_redirect','manage_subscription_redirect' );
// do the redirect
function manage_subscription_redirect(){

  global $wp;
  $query_vars = $wp->query_vars;

	if(    array_key_exists('nhm_endpoint', $query_vars) && 
		'manage_subscriptions' == $query_vars['nhm_endpoint']
	){
		$user_id = get_current_user_id();
		$subscription_ids = WCS_Customer_Store::instance()->get_users_subscription_ids( $user_id );
		$sub_id= $subscription_ids[0];
		wp_redirect(get_home_url(null,"my-account/view-subscription/$sub_id"));
		do_action('qm/debug',$subscription_id);	
	}
}
function get_sub_id(){
	$subscription_ids = WCS_Customer_Store::instance()->get_users_subscription_ids( $user_id );
	$sub_id= $subscription_ids[0];
	return $sub_id;

}
