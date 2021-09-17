<?php

//ADD endpoint
add_action('init', 'create_recipe_archive_endpoint');
//redirect to the template
add_action('template_redirect', 'get_recipe_archive_template');
add_action('template_redirect', 'stop_over_pagination');

function create_recipe_archive_endpoint(){

  global $wp, $wp_rewrite;
  $wp->add_query_var('nhm_endpoint');
  $wp->add_query_var('category-pagination');
  add_rewrite_endpoint('recipe-categories', EP_ROOT);
  $wp_rewrite->add_rule('recipe-categories/?$', 'index.php?nhm_endpoint=recipe-categories', 'top');
  $wp_rewrite->add_rule('recipe-categories/([0-9]{1,})/?$', 'index.php?nhm_endpoint=recipe-categories&category-pagination=$matches[1]', 'top');
}

function get_recipe_archive_template(){
  global $wp;
  $query_vars = $wp->query_vars;
  stop_over_pagination();
  if(
    array_key_exists('nhm_endpoint', $query_vars) && 
    'recipe-categories' == $query_vars['nhm_endpoint']){

      global $wp_query;
      $wp_query->set('is_404', false);
      
      include NHM_DIR . '/archive-recipe_category.php';
    exit;
  }
}


// HOOKS THAT RUN WHEN THESE QUERY VARS ARE SET

//Adds a title to the document since its a custom endpoint we have to tell wordpress what it is
add_filter('document_title_parts', 'update_nhm_title_recipe_categories', 99, 1);    
function update_nhm_title_recipe_categories($title){
  global $wp;
  $query_vars = $wp->query_vars;

  if(array_key_exists('nhm_endpoint', $query_vars) && 'recipe-categories' == $query_vars['nhm_endpoint']){
    $title['title'] = "Recipe Categories";
    if(array_key_exists('category-pagination', $query_vars)) {
      $title['page'] = $query_vars['category-pagination'];
    }
  }

  return $title;
}

function stop_over_pagination(){
  global $wp;
  $query_vars = $wp->query_vars;

  if(!array_key_exists('category-pagination', $query_vars)) return;// early
  
  $page = intval($query_vars['category-pagination']);
  $total_categories = wp_count_terms('recipe_category');
  $total_pages = $total_categories / 5;
  
  if(array_key_exists('category-pagination', $query_vars)){
    if($page > floor($total_pages)){
      global $wp_query;
       $wp_query->set_404();
       add_action( 'document_title_parts', function ($t) {
        $t['title'] ='404: Not Found';
        return $t;
    }, 9999 );
      status_header( 404 );
        nocache_headers();
        require get_query_template( '404' );

      exit;
    }
  }
}
