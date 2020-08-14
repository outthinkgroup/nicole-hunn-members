<?php


function screen_caffeine_toggle(  ) {
  ob_start(); ?>
  <div class="wake-lock-toggle">
    <label class="toggle__label">
      <input type="checkbox" name="" id="" class="toggle__checkbox" />
      <div class="toggle__wrapper">
        <div class="toggle__bg"></div>
        <div class="toggle__switch"></div>
      </div>
    </label>
  </div>
  <?php
  $html = ob_get_clean();
  return $html;
}
add_shortcode( 'screen_caffeine', 'screen_caffeine_toggle' );