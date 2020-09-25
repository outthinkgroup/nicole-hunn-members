<?php

add_action('wp', function(){
	if(is_wc_endpoint_url('edit-account') && !is_user_logged_in()){
		add_filter('body_class', function($classes){
      $classes[] = 'customer-login';
      return $classes;
    },10,2);
	}
});