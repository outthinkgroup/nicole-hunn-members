<?php

//? THE LIVE POST TYPE
function create_posttype_live() {
    register_post_type( 'live',
        array(
            'labels' => array(
                'name' => __( 'GFOAS Lives' ),
                'singular_name' => __( 'GFOAS Lives' )
            ),
            'public' => true,
            'has_archive' => true,
            'rewrite' => array('slug' => 'gfoas-lives'),
            'show_in_rest' => true,
            'supports' => ['thumbnail', 'title', 'custom fields', 'editor']
        )
    );
}
add_action( 'init', 'create_posttype_live');