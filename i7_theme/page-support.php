<!DOCTYPE html(lang="ru")>
<html>
  
  <?php get_header(); ?>
  <body>
    <div class="wrapper">
      
      <?php include get_template_directory() . "/sections/section-header.php" ?>
      
      <div class="pagecontent">
        <section class="container page_top">
          <div class="row">
            <div class="col-12">
              <div class="top-title" style="background-image: linear-gradient(90deg, rgba(0,0,0,0.65) 50%, rgba(0,0,0,0.65) 100%), url('<?php echo get_template_directory_uri(); ?>/img/backgrounds/Podderzhka.jpg')">
                <h1>Поддержка</h1>
                <div class="text-big"><?php echo category_description(32); ?></div>
              </div>
            </div>
          </div>
        </section>
        <section class="container">
          <div class="row">
            <div class="col-12 page_middle">
              <?php 
              $sub_cats = get_categories( array(
              	'parent' => 32,
              	'hide_empty' => 0
              ) );
              	?>
               
              <div class="sidebar">
                <div class="side-menu">
                  <div class="title">Поддержка</div>
                  <div class="menu-wrapper">
                    
                    <?php 
                    if( $sub_cats ): ?>
                    
                    <ul>
                      <li hidden="hidden"></li>
                      	<?php 
                      foreach( $sub_cats as $cat ) :
                      ?>
                      
                      <li class="menu-item"><a class="title" href="<?php echo "#" . $cat->slug ?>"><?php echo $cat->name ?></a></li>
                      <?php 
                      endforeach; ?>
                      
                    </ul>
                    <?php 
                    endif;
                    ?>
                    
                  </div>
                </div>
              </div>
              <div class="right-content">
                <div class="js-menu-pages" data-page="" data-title="">
                  <div class="row support-cards">
                    
                    <?php 
                    if( $sub_cats ):
                    	foreach( $sub_cats as $cat ) : 
                    ?>
                    
                    <div class="col-xl-4"><a class="support-card gray-card" href="<?php echo "#" . $cat->slug ?>">
                        <h6 class="support-card_title"><?php echo $cat->name ?></h6>
                        <div class="support-card_descr text-small">
                          <p><?php echo $cat->description ?></p>
                        </div>
                        <div class="support-card_trumb"><img src="<?php echo get_field("category-trumb", "category_" . $cat->term_id) ?>"/></div></a></div><?php 
                    endforeach;
                    endif;
                    ?>
                  </div>
                </div>
                <?php 
                if( $sub_cats ):
                	foreach( $sub_cats as $cat ) : 
                ?>
                
                <div class="js-menu-pages" data-page="<?php echo $cat->slug ?>" data-title="<?php echo $cat->name ?>">
                  <div class="row">
                    <div class="col-12 js-content-recipient"><?php get_new_cards($cat->term_id); ?></div>
                  </div>
                  <div class="row">
                    <div class="col-12 text-center">
                      
                      <?php $max_pages = get_max_pages_on_category($cat->term_id, '3'); ?>
                      <?php if($max_pages > 1) : ?>
                      <button class="btn_white loader_new_cards" data-page="2" data-category="<?php echo $cat->term_id ?>" data-container=".js-content-recipient" data-maxpage="<?php echo $max_pages ?>"> <span>Показать еще</span></button><?php endif ?>
                      
                    </div>
                  </div>
                </div><?php 
                endforeach;
                endif;
                ?>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <?php get_footer('', 'white'); ?>
  </body>
</html>