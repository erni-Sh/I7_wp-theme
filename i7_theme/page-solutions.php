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
              <div class="top-title" style="background-image: linear-gradient(90deg, rgba(0,0,0,0.65) 50%, rgba(0,0,0,0.65) 100%), url('<?php echo get_template_directory_uri(); ?>/img/backgrounds/Reshenija.jpg')">
                <h1>Решения</h1>
                <div class="text-big"><?php echo category_description(25); ?></div>
              </div>
            </div>
          </div>
        </section>
        <section class="container js-card-menu-container">
          <div class="row page-solution solutions">
            
            <?php
            $solution_cat = get_terms('product_cat', 'parent=25&orderby=term_order&hide_empty=0');
            	if($solution_cat) :
            foreach ($solution_cat as $cat) :
            ?>
            <div class="col-xl-3 col-md-4"><a class="solution-card" href="<?php echo "#" . $cat->slug; ?>" style="background-color: <?php echo get_field("color", "product_cat_" . $cat->term_id) ?>">
                <div class="solution-card_inner">
                  <div class="solution-card_trumb">
                    <?php 
                    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                    ?><img src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>"/>
                  </div>
                  <div class="solution-card_title">
                    <h5><?php echo $cat->name; ?></h5>
                  </div>
                </div></a></div><?php
            	endforeach;
            	endif;
            ?>
          </div>
        </section>
        <section class="container js-card-menu-inside-container">
          <div class="row">
            <div class="col-12 page_middle">
              <div class="sidebar">
                <div class="side-menu">
                  <div class="menu-wrapper">
                    <ul>
                      
                      <?php
                      	if($solution_cat) :
                      foreach ($solution_cat as $cat) :
                      ?>
                      
                      <li class="menu-item"><a class="title" href="<?php echo "#" . $cat->slug; ?>"><?php echo $cat->name; ?></a></li>
                      <?php
                      	endforeach;
                      	endif;
                      ?>
                      
                    </ul>
                  </div>
                </div>
              </div>
              <div class="right-content">
                
                <?php
                	if($solution_cat) :
                foreach ($solution_cat as $cat) :
                ?>
                
                <div class="js-menu-pages" data-page="<?php echo $cat->slug; ?>" data-title="<?php echo $cat->name; ?>">
                  <div class="row pos-rel recip-solution-r-content" style="display:none"></div>
                  <div class="row">
                    <div class="col-12">
                      <button class="btn_white js-loader ldr-r-content is-hidden" data-page="1" data-category="<?php echo $cat->slug; ?>" data-recipient=".recip-solution-r-content" data-action="showSolutionInsideCard"><span>Показать еще</span></button>
                      <div class="lds-facebook">
                        <div></div>
                        <div></div>
                        <div></div>
                      </div>
                    </div>
                  </div>
                </div>
                <?php
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