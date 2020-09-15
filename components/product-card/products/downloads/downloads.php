<?php

function nhm_user_downloads($user_id, $num = 3){
  $downloads = get_posts('post_type=member_content&posts_per_page='.$num);
	return $downloads;
}