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