<?php

function util_navigation_and_search(){
  ?>
  <span class="use-tailwind">
  <div class="top-bar shadow-sm">
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
      <a 
        data-part="notifications" 
        href="#" 
        class=""
      >
        <span class="">
          <?php get_icon('bell'); ?>
        </span>
      </a>
      <a 
        data-part="profile-link" 
        href="my-account" 
        class=""
      >
      <span class="">
        <?php get_icon('user', 'solid'); ?>
      </span>
      </a>
    </div>
  </div>
  </span>
  <?php
}