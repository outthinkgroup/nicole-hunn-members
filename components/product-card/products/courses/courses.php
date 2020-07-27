<?php

add_filter('card_bottom_classes', function($card_bottom_classes, $product){
  if($product->post_type == 'sfwd-courses'){
    $card_bottom_classes .= ' course-card-bottom';
  }
  return $card_bottom_classes;
}, 10, 2);

add_action('product_card_top', function($product){
  if($product->post_type !== 'sfwd-courses') return;
  $course_progress = get_user_meta( get_current_user_id(), '_sfwd-course_progress', true )[$product->ID];
  $completed = $course_progress['completed'];
  $total = $course_progress['total'];
  $percentage_complete = $completed / $total * 100;
  ?>
  <div class="course-completion" style="--course-completion:<?php echo $percentage_complete . '%';  ?>;">
    <div class="percentage"></div>
  </div>
  <?php
},10,1);

function nhm_user_courses($user_id){
	$courses = []; 
	$course_ids = ld_get_mycourses($user_id);
	foreach($course_ids as $course_id){
		$course = get_post($course_id);

		$courses[] = $course;
	}
	return $courses;
}