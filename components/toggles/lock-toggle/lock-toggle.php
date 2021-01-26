<?php
function lock_toggle($default_position="false", $options=['action'=>"", 'title'=>""]){
  
  ?>
  <label class="toggle lock-toggle" title="<?php echo $options['title']; ?>" >
    <input type="checkbox" class="toggle__checkbox" <?php if($default_position) echo 'checked';?> data-action="<?php echo $options['action'];  ?>"/>
    <div class="toggle__wrapper">
      <div class="toggle__bg"></div>
      <div class="toggle__icon" >
        <span class="icon" data-show="false">
          <?php get_icon('lock', 'solid'); ?>
        </span>
        <span class="icon" data-show="true">
          <?php get_icon('unlock', 'solid'); ?>
        </span>
      </div>
    </div>
  </label>
  <?php
}