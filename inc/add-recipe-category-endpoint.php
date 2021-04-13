<?php

//ADD endpoint
add_action('init', 'create_recipe_archive_endpoint');
//redirect to the template
add_action('template_redirect', 'get_recipe_archive_template');

function create_recipe_archive_endpoint(){

  global $wp, $wp_rewrite;
  $wp->add_query_var('nhm_endpoint');
  add_rewrite_endpoint('recipe-categories', EP_ROOT);
  $wp_rewrite->add_rule('recipe-categories/?$', 'index.php?nhm_endpoint=recipe-categories', 'top');

}

function get_recipe_archive_template(){
  global $wp, $wp_rewrite;
  $query_vars = $wp->query_vars;
  
  if(array_key_exists('nhm_endpoint', $query_vars) && 'recipe-categories' == $query_vars['nhm_endpoint']){
    global $wp_query;
    $wp_query->set('is_404', false);
    include NHM_DIR . '/archive-recipe_category.php';
    exit;
  }
}