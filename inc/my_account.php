<?php

add_filter ( 'woocommerce_account_menu_items', 'nhm_rename_downloads' );
 
function nhm_rename_downloads( $menu_links ){
 
	// $menu_links['TAB ID HERE'] = 'NEW TAB NAME HERE';
	$menu_links['dashboard'] = 'General';
 
	return $menu_links;
}
 