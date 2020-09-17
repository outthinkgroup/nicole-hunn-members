<?php 

function html_to_array($html){
    // filters the_content()
    if(strpos($html, '</p>')){

      $split_by_closing_tag = explode('</p>', $html);
      $list = [];
      foreach($split_by_closing_tag as $item){

        $list_item = str_replace('<p>','',$item);
        
        //removes '' left over from the last '</p>'
        if(strlen($list_item) > 1){
          $list[] = $list_item;
        }
      }
      return $list;
      
    } else {
      return $html;
    }
}

add_shortcode( 'ingredients', 'recipe_ingredients' );

function recipe_ingredients( $atts ) {
    $atts = shortcode_atts( array(
        'foo' => 'no foo',
        'baz' => 'default baz'
    ), $atts, 'ingredients' );
    global $post;
    ?>
    <?php
    $ingredients = get_field('ingredients', $post->ID);
    $htmlarr = html_to_array($ingredients);
    $content = '';
    $content .= '<ul class="ingredients-list">';
    foreach ($htmlarr as $key => $value) {
      $content .= '<li>'.$value.'</li>';
    }
  $content .= '</ul>';
  return $content;
}

add_shortcode( 'recipe_steps', 'show_recipe_steps' );
function show_recipe_steps( $atts ) {
  $atts = shortcode_atts( array(
  ), $atts, 'recipe_steps' );
  ob_start(); ?>
  
  
  <?php // Check rows exists.
  if( have_rows('steps') ): ?>
  <ol class="step-list"> 
    <?php
      // Loop through rows.
      while( have_rows('steps') ) : the_row();

          // Load sub field value.
          $sub_value = get_sub_field('step');
          // Do something...
          ?>
          <li><?php echo $sub_value; ?></li>
          <?php
      // End loop.
      endwhile; ?>
      </ol><!-- end step-list-->
      <?php
    endif;
  // need more stuff here.
  return ob_get_clean();
}

add_shortcode( 'recipe_notes', 'gf_recipe_notes' );
function gf_recipe_notes( $atts ) {
  $valueatts = shortcode_atts( array(
  ), $atts, 'recipe_notes' );
  global $post;
  $notes = get_field('recipe_notes', $post->ID);

  if( $notes ) {
      return $notes;
  } else {
      return "<h4>No notes for this recipe</h4><p>This recipe has no notes to display.</p>";
  }
  return $notes;
}

add_shortcode( 'gfoas_video', 'gf_video_filter' );
function gf_video_filter( $atts ) {
  $atts = shortcode_atts( array(
  ), $atts, 'gfoas_video' );
  global $post;
  $youtube_url = get_field('youtube_url', $post->ID); 
  $youtube_id = gov_get_video_id_from_url($youtube_url);
  ob_start(); ?>
  <style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'>
  <iframe id='player' frameborder='0' allowfullscreen='1' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' title='GFOAS Members Video' width='100%' height='100%' 
  src='https://www.youtube-nocookie.com/embed/<?php echo $youtube_id; ?>?iv_load_policy=3&cc_load_policy=1&title=0&modestbranding=1&playsinline=1&rel=0&controls=0&autoplay=0&enablejsapi=1'></iframe></div>
  <?php
  return ob_get_clean();
}


function gov_get_video_id_from_url($url) {
	if(strpos($url, "youtube.com") !== false || strpos($url, "youtu.be") !== false)
	{
		//Video is from YouTube
		$url_string = parse_url($url, PHP_URL_QUERY);
  		parse_str($url_string, $args);
  		if(isset($args['v']))
		{
			return $args['v'];
		}
		else
		{
			$path = parse_url($url, PHP_URL_PATH);
			if(strlen($path) > 1)
			{
				$path = str_replace("/", "", $path);
				return $path;
			}
			else
			{
				return false;
			}	
		}	

	}
	if(strpos($url, "vimeo") !== false)
	{
		//Video is from Vimeo	
		$path = parse_url($url, PHP_URL_PATH);
		if(strlen($path) > 1)
		{
			$path = str_replace("/", "", $path);
			return $path;
		}
		else
		{
			return false;
		}	
	}
}

//Recipe Title filter to add add to collections button beside
add_filter('the_title', function($title, $id){
  if(is_single() && ( get_post_type($id) === 'recipe' )){
    $title = '<span class="title-add-to-collections">' . do_shortcode('[add_recipe_button  icon_button=true]') . '</span> ' . $title;
  }
  return $title;
},10, 2);
