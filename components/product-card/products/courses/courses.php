<?php


add_action('after_product_card_image', function($product){
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

