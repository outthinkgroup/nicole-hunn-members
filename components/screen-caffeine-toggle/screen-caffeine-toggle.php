<?php


function screen_caffeine_toggle( $atts ) {
   $param = shortcode_atts( array(
    'insert_into' => null,
    'position'  => 'top-right',
	), $atts );

  if(!$param['insert_into']){
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
  } else {
    $parent_selector = $param['insert_into'];
    ob_start(); ?>
    <script>
      const el = document.createElement('div');
      el.classList.add('wake-lock-toggle')
      el.classList.add('top-right')
      
      el.innerHTML = `
          <label class="toggle__label">
            <span style="color:inherit;">Keep Screen From Going to Sleep</span>
            <input type="checkbox" name="" id="" class="toggle__checkbox" />
            <div class="toggle__wrapper">
              <div class="toggle__bg"></div>
              <div class="toggle__switch"></div>
            </div>
          </label>
      `
      const parentEl = document.querySelector('<?php echo $parent_selector; ?>')
      if(parentEl){
        parentEl.appendChild(el)
      }
    </script>
    <?php 
    $html = ob_get_clean();
  }
  return $html;
}
add_shortcode( 'screen_caffeine', 'screen_caffeine_toggle' );