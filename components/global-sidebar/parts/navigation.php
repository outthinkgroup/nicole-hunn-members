<?php
function get_sidebar_nav(){
  ?>
  
  <nav class="">
    <?php 
    wp_nav_menu( array( 'theme_location' => 'sidebar_top', 'walker' => new Icon_Items_Nav_Menu() ) );
    ?>
  </nav>

  <?php
}

function menu_nav_link($name, $attrs, $id){
  $icon = get_field('icon', $id);
  $icons_folder = get_field('icons_folder', $id);
  ?> 
  <a 
    <?php echo $attrs ?>
  >
  <?php 
    if($icon):?>
    <span class="icon">
      <?php get_icon($icon, 'solid'); ?>
    </span>
    <?php endif; ?>
    <span class="link-text"><?php echo $name; ?></span>
  </a>
  <?php
}

class Icon_Items_Nav_Menu extends Walker_Nav_Menu {
 
  function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
    global $wp_query;
    $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

    // Depth-dependent classes.
    $depth_classes = array(
        ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
        ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
        ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
        'menu-item-depth-' . $depth
    );
    $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

    // Passed classes.
    $classes = empty( $item->classes ) ? array() : (array) $item->classes;
    $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

    // Build HTML.
    $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

    // Link attributes.
    $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
    $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
    $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
    $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
    $attributes .= ' class="menu-link nav-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';

    
    $link_title = apply_filters( 'the_title', $item->title, $item->ID );
    
    ob_start();
    menu_nav_link( $link_title, $attributes,  $item->ID);  
    $my_menu_item = ob_get_clean();

    $item_output = $my_menu_item;
    if(in_array('menu-item-has-children',$item->classes)):
      ob_start();
      ?>
      <button data-action="toggle-sub-menu" class="toggle-sub-menu" >
        <span class="icon"> <?php get_icon('chevron-down', 'solid'); ?> </span>
      </button>
      <?php
      $output .= ob_get_clean();
    endif; 
    $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    

  }
 
}

