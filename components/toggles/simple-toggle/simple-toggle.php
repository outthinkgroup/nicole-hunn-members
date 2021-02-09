<?php
function simple_toggle($default_position="false", $options=['action'=>"", 'title'=>""]){
  ?>
  <div class="simple-toggle" title="<?php echo $options['title']?>">
    <label class="toggle__label" >
      <input type="checkbox" class="toggle__checkbox" title="<?php echo $options['title']; ?>" <?php if($default_position) echo 'checked';?> data-action="<?php echo $options['action'];  ?>"/>
      <div class="toggle__wrapper">
        <div class="toggle__bg"></div>
        <div class="toggle__switch"></div>
      </div>
    </label>
  </div>
  <?php
}