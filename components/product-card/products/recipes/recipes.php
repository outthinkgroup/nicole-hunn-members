<?php
function nhm_all_recipes(){
  $args = [
    'post_type' => 'recipe',
    'posts_per_page' => 3,
  ];
  $recipes = get_posts($args);
  return $recipes;
}