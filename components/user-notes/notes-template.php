<?php ?>

<div class="user-notes" id="notes">
<?php
global $post;
$user = wp_get_current_user();
$comments = get_comments(['post_id'=>$post->ID, 'user_id' => $user->ID]);


$list_args = array(
    'reverse_top_level' => true, // Show the latest comments at the top of the list,
    'callback'=> 'gf_user_note'
);
    wp_list_comments( $list_args, $comments );
?>
</div>
