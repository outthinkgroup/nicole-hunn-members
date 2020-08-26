<?php
add_action( 'after_setup_theme', 'register_sidebar_menu' );
function register_sidebar_menu() {
  register_nav_menu( 'sidebar_top', __( 'Sidebar Top', 'NHM' ) );
}
