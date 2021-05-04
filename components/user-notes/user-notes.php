<?php
 //gets only the users comments
function gf_get_user_notes(){
  global $post;
  $user = wp_get_current_user();
  ?>
  USER NOTES
  <?php
}
 // gets the comment form
function gf_get_note_form(){
  ob_start(); ?>
  <p class="comment-form-comment">
    <label for="comment">Add A Note</label> 
    <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required">
    </textarea>
  </p>
  <?php 
  $comment_html = ob_get_clean();
  comment_form([
    'title_reply_before'=>"",
    'title_reply'=>"",
    'title_reply_after'=>"",
    "logged_in_as"=>"",
    "comment_field"=>$comment_html,
    "submit_button"=>'<input name="%1$s" type="submit" id="%2$s" class="%3$s" value="Add Note" />'
  ]);

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