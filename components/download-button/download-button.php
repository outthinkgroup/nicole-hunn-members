<?php
global $post;
function get_download_buttons($id = null){
    
    $rows = $id ? get_field('member_content_downloads', $id) : get_field('member_content_downloads');
    if( $rows ) {
      ?> <div class="flex flex-start"> <?php
        foreach($rows as $row): ?>
        <?php
        $is_download = isset($row['file_download']['url']);
        $download_link = $is_download ? $row['file_download']['url'] : $row['link_download'];
        ?>
          <a 
            href="<?php echo $download_link; ?>"
            <?php if($is_download) echo 'download'; ?>
          >
            <?php echo $row['download_label']; ?>
          </a>
        <?php endforeach; ?>
      </div> <?php
    }

}