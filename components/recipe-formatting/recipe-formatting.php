<?php 
function html_to_array($html){
    // filters the_content()
    if(strpos($html, '</p>')){

      $split_by_closing_tag = explode('</p>', $html);
      $list = [];
      foreach($split_by_closing_tag as $item){

        $list_item = str_replace('<p>','',$item);
        
        //removes '' left over from the last '</p>'
        if(strlen($list_item) > 1){
          $list[] = $list_item;
        }
      }
      
      return $list;
      
    } else {
      return $html;
    }
  }