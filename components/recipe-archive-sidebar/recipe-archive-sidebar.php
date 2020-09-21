<?php
function recipe_archive_sidebar(){
  $user = wp_get_current_user();
  $user_id = $user->ID;
  ?>
  <aside>
    <div class="widgets">

      <div class="filter-widget">
        <h3>Filter Recipes by Title</h3>
        <div class="search-wrapper">
          <form class="search-bar shadow-sm" action="/" method="GET" data-action="filter">
            <input 
              placeholder="Filter"
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
      </div>

      <?php if($user_id): ?>
      <div class="recipe-collections">
        <h3>My Recipe Collections</h3>
        <?php
          $collections = get_posts([
            'post_type' => 'lists', 
            'posts_per_page' => 5,
            'author'  => $user_id
          ]);
          ?>
          <ul>
          <?php foreach ($collections as $collection): ?>
            <li>
              <a href="<?php echo get_permalink($collection->ID); ?>" class="card">
                <span class="count">
                  <?php echo count(get_post_meta($collection->ID, 'list_items')); ?>
                </span>
                <?php echo $collection->post_title; ?>
              </a>
            </li>
          <?php endforeach; ?>    
          </ul>
          <a href="/collections">View all collections</a>
      </div>  
      <?php endif; ?>

      <div  class="recipe-categories">
        <h3>Recipe Categories</h3>
        <ul>
        <?php
          $categories = get_terms('recipe_category');
          foreach($categories as $category){
            ?>
            <li >
              <a class="shadow-sm card" href="<?php echo get_term_link($category); ?>" > <?php echo $category->name; ?></a>
            </li>
            <?php
          }
        ?>
        </ul>
      </div>

    </div>
  </aside>
  <?php
}