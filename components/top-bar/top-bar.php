<?php

function util_navigation_and_search(){
  ?>
  <span class="use-tailwind">
  <div class="top-bar shadow-sm">
    <div class="mobile" data-part="toggle-sidebar">
      <button class="button-icon top-bar__button" data-action="open-sidebar">
        <span class="icon">
          <?php get_icon('bars', 'solid'); ?>
        </span>
      </button>
    </div>
    <div class="search-wrapper">
      <form class="search-bar shadow-sm" action="/" method="GET">
      <input 
        placeholder="Search"
        type="search"
        name="s"
        value="<?php echo get_search_query() ?>"
        id="s"
      />
      <button type="submit" >
        <span >
          <?php get_icon('search', 'solid'); ?>
        </span>
      </button>
    </form>
    </div>
    <div class="button-group">
      <?php get_notification_button(); ?>
      <a 
        data-part="profile-link" 
        href="/my-account" 
        class=""
      >
      <span class="">
      <?php echo get_avatar( $current_user->ID, $size = '30'); ?>
        <?php //get_icon('user', 'solid'); ?>
      </span>
      </a>
    </div>
  </div>
  </span>
  <?php
}

function get_notification_button(){
  ?>
  <div class="top-bar__button notification-wrapper" data-state="closed">
    <button 
    data-part="notifications"  
    class=""
    >
    <span class="" >
      <?php get_icon('bell'); ?>
      <?php notification_dot();?>
    </span>
  </button>
  <div class="recent-updates-card">
    <header>
      <h3>Recent Updates</h3>
    </header>
    <ul>
      <?php 
      $posts = get_posts([
        'posts_per_page' => 8,
      ]);
      foreach ($posts as $the_post){ 
      ?>
      <li>
        <a href="<?php echo get_the_permalink($the_post->ID); ?>">
          <h4>
            <?php echo $the_post->post_title; ?>
          </h4>
          <time datetime="<?php echo $the_post->post_date; ?>">
            <?php echo nhm_format_date($the_post->post_date); ?>
          </time> 
        </a>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
  <?php
}
function notification_dot(){
  ?>
    <div class="dot" data-notify="<?php echo does_user_need_notification(get_current_user_id()); ?>">
    </div>
  <?php
}

function nhm_format_date($date){
  $date_string = strtotime($date);
  return date('F j, Y', $date_string);
}