<?php
/*
* Template Name: Member Content Archive
*/
get_header();
$user = wp_get_current_user();
$user_id = $user->ID;
?>

	<div class="archive-template-layout">
		<header>
			<h2><?php echo the_title(); ?></h2>
		</header>
		<?php

		?>
		<main class="page-mx-width">
      <div class="recipe-grids">
        <?php
					$downloads = nhm_user_downloads($user_id, '-1');
          $content_type_group = [];
          foreach($downloads as $download){
						$content_type= get_the_terms($download->ID, 'content_type')[0];
            $content_type_group[$content_type->name]['posts'][] = $download;
            $content_type_group[$content_type->name]['slug'] = $content_type->slug;
          }
          foreach($content_type_group as $content_type=>$data){
          ?>
          <section class="my-downloads post-collection" >
						<a href="/content_type/<?php echo $data['slug']; ?>" >
							<h3><?php echo $content_type; ?></h3>
						</a>
            <ul class="grid" style="justify-content:space-between;">
              <?php
            foreach($data['posts'] as $_post){ ?>
              
                <?php product_card($_post);?>
              
              <?php } ?>
            </ul>
          </section>
          <?php
            
          }
          
      ?>
    </div> 
    </div>     
  </main>
	</div>


<?php get_footer(); ?>

<!-- 

<main class="page-mx-width">
			<section class="my-downloads">
				<ul class="grid" style="justify-content:center;">
					<?php
						$downloads = nhm_user_downloads($user_id, '-1');
						foreach($downloads as $download){
							product_card($download);
						}
					?>
				</ul>
			</section>
		</main>

 -->