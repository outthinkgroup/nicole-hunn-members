<?php
 //gets only the users comments
function gf_get_user_notes(){
 comments_template();
}
function gf_user_note($note, $args, $somethingelse){ 
  do_action('qm/debug',  $note);
  $del_nonce     = esc_html( '_wpnonce=' . wp_create_nonce( "delete-comment_$note->comment_ID" ) );
  $trash_url     = esc_url( "comment.php?action=trashcomment&p=$note->comment_post_ID&c=$note->comment_ID&$del_nonce" );
  $delete_note = admin_url($trash_url)
  ?>
    <p class="note" data-note-id="<?php echo $note->comment_ID;?>" >
      <?php echo $note->comment_content; ?>
      <button class="icon-button delete" data-url="<?php echo $delete_note;?>">
        <span class="icon">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512" style="width:1em;">
            <path
              d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19
              0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93
              89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19
              0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24
              22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28
              32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z" />
          </svg>
        </span>
      </button>
    </p>
  
 <?php }
// https://members.nicolehunn.local/wp-admin/comment.php?c=17846&action=trashcomment&_wpnonce=4af46475dd
add_filter( "comments_template", "recipe_comment_template" );
function recipe_comment_template( $comment_template ) {
  global $post;
  if ( !( is_singular() && (  'open' !== $post->comment_status ) ) ) {
    return;
  }
  if($post->post_type == 'recipe'){ // assuming there is a post type called business
    return dirname(__FILE__) . '/notes-template.php';
  }
  return $comment_template;
}

// sort comments by date
function sort_by_date($comment_a, $comment_b){
  $a_date = intval($comment_a->comment_date);
  $b_date = intval($comment_b->comment_date);
  if ($a_date == $b_date) {
    return 0;
  }
  return ($a_date > $b_date) ? 1 : -1;
}
 

 // gets the comment form
function gf_add_note_form(){
  ob_start(); ?>
  <p class="comment-form-comment">
    <label for="comment">Add A Note</label> 
    <textarea id="comment" name="comment" cols="45" rows="8" maxlength="65525" required="required"></textarea>
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
  if(get_post_type($post_id) == 'recipe'){  
    
    $open = true;
  }
  return $open;
}