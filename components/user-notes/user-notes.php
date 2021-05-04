<?php
 //gets only the users comments
function gf_get_user_notes(){
  global $post;
  $user = wp_get_current_user();
  ?>˝
  USER NOTES
  <?php
}
 // gets the comment form
function gf_get_note_form(){
  comment_form($post->ID);
}

// Turns on comments for all recipes
add_filter( 'comments_open', 'turn_on_comments_for_recipes', 10, 2 );
function turn_on_comments_for_recipes($open, $post_id){
  global $post;
  if(get_post_type($post_id) == 'recipe'){  
    $open = true;
  }
  return $open;
}