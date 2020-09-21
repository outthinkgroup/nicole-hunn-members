<?php
// [start_module]
function ld_show_first_topic($atts) {
	extract(shortcode_atts(array(
	), $atts));
	global $post;
	//$course_id = learndash_get_course_id( $post->ID );
	$topics = learndash_get_topic_list( $post->ID );
	ob_start(); ?>
	<p>
		<a href="<?php echo get_permalink($topics[0]->ID); ?>" class="btn btn-lg">Go to first lesson in module</a>
	</p>
	<?php $return = ob_get_clean();
	return $return;
}
add_shortcode("start_module", "ld_show_first_topic");

/* Function to get the last lesson in a course */
function ld_get_last_lesson_in_course($id) {
    $lessons = learndash_get_lesson_list( $course_id, array( 'num' => 0 ) );
    //print_r($lessons);
    $last = end($lessons);
    //print_r($last);
    return $last->ID;
}
// this gets the last topic in any lesson
function ld_get_last_topic_in_lesson($parent_lesson_id) {
    $topics = learndash_get_topic_list( $parent_lesson_id );
    $last = end($topics);
    return $last->ID;
}

// this gets the last topic in any lesson
function ld_get_first_topic_in_lesson($parent_lesson_id) {
    $topics = learndash_get_topic_list( $parent_lesson_id );
    $first = $topics[0];
    return $first->ID;
}
function ld_get_first_lesson_in_course($id) {
    $lessons = learndash_get_lesson_list( $course_id, array( 'num' => 0 ) );
    //print_r($lessons);
    $first = $lessons[0];
    //print_r($last);
    return $first->ID;
}

function search_multidimen($haystack, $needle) {
    foreach($haystack as $index => $hay) {
        if($hay->ID == $needle) return $index;
    }
    return FALSE;
}


function ld_add_next_lesson_to_content($content) {
    global $post;
    $return = $content;
    $ptype = get_post_type();
    if ($ptype == 'sfwd-topic') {
        // storing the course ID for a quick lookup later
        $course_id = learndash_get_course_id( $post->ID );
        // storing the lessons so we can find where we are and traverse through the course structure 
        $lessons = learndash_get_lesson_list( $course_id, array( 'num' => 0 ) );
        // finding THIS topic's parent lesson so we can know WHERE we are.
        $parent_lesson_id = learndash_get_setting( $post, 'lesson' );
        
        // getting all sibling topicss
        $siblings = learndash_get_topic_list( $parent_lesson_id );
        // finding the key of THIS topic
        $thisKey = search_multidimen($siblings, $post->ID);
        // finding the key of THIS lesson.
        $lessonKey = search_multidimen($lessons, $parent_lesson_id);
        // this is the last lesson in the course

        $lastLesson = ld_get_last_lesson_in_course($course_id);
        $firstLesson = ld_get_first_lesson_in_course($course_id);
        // this is the last topic of THIS lesson
        $lastTopic = ld_get_last_topic_in_lesson($parent_lesson_id);
        $firstTopic = ld_get_first_topic_in_lesson($parent_lesson_id);

        // check to see if this is the last lesson in the course, if it's not, what comes next.
        if ($parent_lesson_id !== $lastLesson) {
            // now that we have the next lesson key, let's get the first topic
            $nextLessonKey = $lessonKey+1;
            if ($nextLessonKey){
                // the next lesson is identified in the array "lessons" by its key
                $nextLesson = $lessons[$nextLessonKey];
                // the topics for this lesson can be found using the learndash function
                $topicsInNextLesson = learndash_get_topic_list( $nextLesson->ID );
                // The first topic would be the 0 key in the array.
                $firstTopicInNextLesson = $topicsInNextLesson[0];
                // now firstTopic is the WP Object and can be used as you would a post object.
            }
        }
        // if the parent lesson is NOT the first lesson
        if ($parent_lesson_id !== $firstLesson) {
            $prevLessonKey = $lessonKey-1;
            $prevLesson = $lessons[$prevLessonKey];
            // the topics for this lesson can be found using the learndash function
            $prevLessonLastTopic = learndash_get_topic_list( $prevLesson->ID );
            $prevLessonLastTopic = end($prevLessonLastTopic);
        }
        
        
        $nextKey = $thisKey+1;
        // nextTopic is the next topic object
        $nextTopic = $siblings[$nextKey];
        // to get the previous, we must first establish, it's more than 0.
        if ($thisKey > 0) {
            $prevKey = $thisKey-1;
            //echo $thisKey . '<br>';
            //echo $prevKey;
            //die;
            // prevtopic is the object of the previous topic.
            $prevTopic = $siblings[$prevKey];
        } else {
            $prevTopic = false;
        }
        $return .= '<p id="learndash_next_prev_link">';
        // if this is the first topic

        if ($post->ID == $firstTopic) {
            // AND it's the first lesson
            if ($firstLesson === $parent_lesson_id) {
             // it's the first lesson, and it's the first topic. no navigation possible
            } else {
            // otherwise, there are more in front of it, so you need to go back one lesson and get the last lesson
                $return .= '<a class="prev-link" rel="previous" href="'.get_permalink($prevLessonLastTopic->ID).'">< Previous Lesson</a>';
            }
        } else {
                $return .= '<a class="prev-link" rel="previous" href="'.get_permalink($prevTopic->ID).'">< Previous Lesson</a>';
        }
       // function for NEXT topic link.
        if ($post->ID == $lastTopic) {
            // this would indicate the end of the course.
            if ($lastLesson == $parent_lesson_id) {
                // the student has reached the end of the course.
                // don't say anything
            } else {
                //var_dump($lessons[$nextLessonKey]);
                $return .= '<a class="next-link" rel="next" href="'.get_permalink($firstTopicInNextLesson->ID).'">Next Lesson ></a>';
            }
        } else {
            // otherwise it's NOT the last topic, so let's get the next id:
            if ( !empty($nextTopic) ) {
                $return .= '<a class="next-link" rel="next" href="'.get_permalink($nextTopic->ID).'">Next Lesson ></a>';
            }
            
            
        }
        $return .= '</p>';
    }

	return $return;
}

add_filter( 'the_content', 'ld_add_next_lesson_to_content' );

// this filter removes the default next/previous links from the course so we can add our own.
function replace_next_post_link( $link, $permalink, $link_name, $post ) {
    // we're killing this in favor of our own system.
    $link = '';
    return $link;
}
add_filter( 'learndash_next_post_link', 'replace_next_post_link', 10, 4 );
add_filter( 'learndash_previous_post_link', 'replace_next_post_link', 10, 4 );

function ld_get_last_completed_ID($pid) {
    global $current_user;
    $course_progress = get_user_meta($current_user->ID, '_sfwd-course_progress', true);
	$ptype = get_post_type();
	$course_id = learndash_get_course_id( $pid );

	if ( !empty( $course_progress ) )  {
		$return =  $course_progress[$course_id]['last_id'];
	} else {
		$return = $course_id;
    }
    // should return an ID - either the course ID, or the last completed lesson.
    return $return;
}

// [ld_last_completed]
function ld_resume_course_progress($atts) {
	extract(shortcode_atts(array(
		'text' => 'Resume Progress',
		'url' => false,
	), $atts));
    $return = '';
    // I think starting here should be a function.
	global $post;
	global $current_user;
	$course_progress = get_user_meta($current_user->ID, '_sfwd-course_progress', true);
	$ptype = get_post_type();
	$course_id = learndash_get_course_id( $post->id );

	if ( !empty( $course_progress ) )  {
		$lastID =  $course_progress[$course_id]['last_id'];
		$text = $text;
	} else {
		$notstarted = true;
    }
    // end here
	ob_start();
	if (! $notstarted ) {
		if($url === false) { ?>
			<p>
				<a href="<?php echo get_permalink($lastID); ?>" class="btn btn-sm"><?php echo $text; ?></a>
			</p>
<?php } else {
			echo get_permalink($lastID);
		} ?>
	<?php
	} // notstarted
	$return = ob_get_clean();
	return $return;
}
add_shortcode("ld_last_completed", "ld_resume_course_progress");
// end shortcode

add_action('wp', 'ld_redirect_to_lessons', 10);
// this function basically redirects anyone that comes to the course to the first lesson in the course, or to the last completed lesson.
// additionally, it redirects modules to lessons (or lessons to topics if using default language)
function ld_redirect_to_lessons() {
	global $current_user;
	global $post;
	// commenting out the course progress 
//	$course_progress = get_user_meta($current_user->ID, '_sfwd-course_progress', true);
//	if ( !empty( $course_progress ) )  {
//		$lastID =  $course_progress['2990']['last_id'];
//	} else {
        $course_progress = get_user_meta($current_user->ID, '_sfwd-course_progress', true);
//	}
	if ( $post->post_type === 'sfwd-courses' && !is_admin() ) {
        
        $lessons = learndash_get_lesson_list( $post->ID, array( 'num' => 0 ) );
        // finding THIS topic's parent lesson so we can know WHERE we are.
        $firstLesson = $lessons[0];

        // getting all sibling topicss
        $topics = learndash_get_topic_list( $firstLesson->ID );
        // first topic
        $topic = $topics[0];
        // first topic ID
        $redirID = $topic->ID;
        // This was breaking...for helena
        //if ( !empty( $course_progress ) )  {
          //  if ( ! empty($course_progress[$post->ID]['last_id']) ) {
            //    $redirID = $course_progress[$post->ID]['last_id'];
            //}
        //}
		wp_redirect(get_permalink($redirID));
		exit;
	}
	if ( $post->post_type == 'sfwd-lessons' && !is_admin() ) {
		$topics = learndash_get_topic_list( $post->ID);
		$permalink = get_permalink( $topics[0]->ID );
		wp_redirect($permalink);
		exit;
	}
}

//[course_title]
add_shortcode('course_title', function(){
    global $post;
    $course_id = get_post_meta($post->ID, 'course_id', true);
    $course = get_post($course_id);

    return $course->post_title;
});