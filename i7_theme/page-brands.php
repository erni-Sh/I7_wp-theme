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
              <div class="top-title" style="background-image: linear-gradient(90deg, rgba(0,0,0,0.65) 50%, rgba(0,0,0,0.65) 100%), url('<?php echo get_template_directory_uri(); ?>/img/backgrounds/Brand.jpg')">
                <h1>Бренды</h1>
                <div class="text-big"><?php echo category_description(22); ?></div>
              </div>
            </div>
          </div>
        </section>
        <section class="container page_middle js-card-menu-container">
          <div class="row page-brand solutions">
            
            <?php
            $product_cat = get_terms('product_cat', 'parent=22&orderby=term_order&hide_empty=0');
            	if($product_cat) :
            foreach ($product_cat as $cat) :
            ?>
            <div class="col-xl-3 col-md-4"><a class="solution-card js-scrollUp" href="<?php echo "#" . $cat->slug; ?>" style="background-color: <?php echo get_field("color", "product_cat_" . $cat->term_id) ?>">
                <div class="solution-card_inner">
                  <div class="solution-card_trumb">
                    <?php 
                    $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
                    ?><img src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>"/>
                  </div>
                  <div class="solution-card_logo"><img class="icon" src="<?php echo get_field("icon", "product_cat_" . $cat->term_id); ?>"/><img class="logo" src="<?php echo get_field("logo", "product_cat_" . $cat->term_id); ?>"/></div>
                  <div class="solution-card_descr">
                    <p><?php echo $cat->description; ?></p>
                  </div>
                </div></a></div><?php
            	endforeach;
            	endif;
            ?>
          </div>
        </section>
        <section class="container js-card-menu-inside-container">
          <div class="row page-brand">
            <div class="col-12 page_middle">
              <div class="sidebar">
                <div class="menu-manufacturers swiper-container">
                  <ul class="swiper-wrapper">
                    <?php
                    	if($product_cat) :
                    foreach ($product_cat as $cat) :
                    ?>
                    <li class="swiper-slide manufacturer js-scrollUp"><a href="<?php echo "#" . $cat->slug; ?>"><img class="icon" src="<?php echo get_field("icon", "product_cat_" . $cat->term_id); ?>"/><img class="logo" src="<?php echo get_field("logo", "product_cat_" . $cat->term_id); ?>"/></a></li><?php
                    	endforeach;
                    	endif;
                    ?>
                  </ul>
                </div>
              </div>
              <div class="right-content">
                <?php
                	if($product_cat) :
                foreach ($product_cat as $cat) :
                ?>
                <div class="js-menu-pages" data-page="<?php echo $cat->slug; ?>" data-title="<?php echo $cat->name; ?>">
                  <div class="row">
                    <div class="col-12">
                      <div class="brand-about">
                        <div class="brand-about_logo"><img class="icon" src="<?php echo get_field("icon", "product_cat_" . $cat->term_id); ?>"/><img class="logo" src="<?php echo get_field("logo", "product_cat_" . $cat->term_id); ?>"/></div>
                        <div class="brand-about_descr">
                          <p><?php echo $cat->description; ?></p>
                        </div>
                        <div class="brand-about_title"><?php if($cat->count): ?>
                          <h3>Продукция бренда</h3><?php endif; ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="pos-rel recip-brand-r-content" style="display:none"></div>
                  <div class="row">
                    <div class="col-12">
                      <button class="btn_white js-loader ldr-r-content is-hidden" data-page="1" data-category="<?php echo $cat->slug ?>" data-recipient=".recip-brand-r-content" data-action="render_brand_r_content"><span>Показать еще</span></button>
                      <div class="lds-facebook">
                        <div></div>
                        <div></div>
                        <div></div>
                      </div>
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