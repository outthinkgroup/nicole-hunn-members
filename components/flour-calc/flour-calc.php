<?php

add_action('wp_enqueue_scripts', function(){
  wp_enqueue_script('flour-calc', get_stylesheet_directory_uri() . '/assets/flour-calc/flour-calc.js', [], CHILD_THEME_NICOLE_HUNN_MEMBERS_VERSION, true );
});