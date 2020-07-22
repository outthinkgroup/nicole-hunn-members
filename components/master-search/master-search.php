<?php

function util_navigation_and_search(){
  ?>
  <div class="h-16 bg-white px-4 py-2 flex items-center shadow-sm">
    <form class="searchbar w-full flex item-center bg-gray-100 rounded overflow-hidden shadow-sm">
      <input 
        class="w-full py-2 px-4 bg-gray-100 border-transparent "
        placeholder="Search"
        type="text"
      />
      <button type="submit" class="flex items-center px-4 text-gray-600 hover:bg-gray-200 focus:bg-gray-200 rounded-none">
        <span class="w-4 inline-block fill-current">
          <?php get_icon('search', 'solid'); ?>
        </span>
      </button>
    </form>
    <div class="flex ml-8 items-center">
      <a 
        data-part="notifications" 
        href="#" 
        class="w-10 h-10 hover:bg-gray-200 text-gray-600 rounded-full  flex items-center bg-gray-100 justify-center"
      >
        <span class="fill-current w-4">
          <?php get_icon('bell'); ?>
        </span>
      </a>
      <a 
        data-part="profile-link" 
        href="my-account" 
        class="w-10 h-10 hover:bg-gray-200 text-gray-600 rounded-full flex items-center bg-gray-100 justify-center ml-2"
      >
      <span class="fill-current w-4">
        <?php get_icon('user', 'solid'); ?>
      </span>
      </a>
    </div>
  </div>
  <?php
}