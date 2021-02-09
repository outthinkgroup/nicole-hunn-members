<?php
//List of slugs to protect from un logged in users.

add_action('template_redirect', function(){
  $protected_routes = ['collections', 'lists'];
  global $post;
  global $wp_query;
  
  //IS USER LOGGED IN
  if( wp_get_current_user()->ID ) return;

  // IF POST TYPE IS PROTECTED
  if( in_array( get_post_type(), $protected_routes ) ) {
    protect_page();
  }

  //IF SLUG IS PROTECTED
  if( is_singular() && in_array($post->post_name, $protected_routes ) ) {
    protect_page();
  }

});

function protect_page(){
  header("Location:" . site_url() . '/login');
  exit;
}