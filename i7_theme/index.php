<!DOCTYPE html(lang="ru")>
<html>
  
  <?php get_header(); ?>
  <body>
    <div class="wrapper">
      
      <?php include get_template_directory() . "/sections/section-header.php" ?>
      
      <div class="pagecontent">
        <section class="container main-page_top">
          <div class="row">
            <div class="col-xxl-9 col-lg-8 main-slider_parrent">
              <div class="main-slider swiper-container">
                <div class="swiper-wrapper">
                  
                  <?php
                  	$arg = array(
                      'category'=> 29,
                      'orderby' => 'date',
                  			'order' => 'ASC',
                      'numberposts' => 10,
                    );
                   
                  $posts = get_posts($arg);
                  if ($posts) :
                  foreach ($posts as $post) :
                  setup_postdata($post);
                  ?>
                  
                  
                  <?php 
                  $link = get_field("slider-link");
                  $target = "_blank";
                  if(strpos($link, get_site_url()) !== false) $target = "_self"
                  ?>
                  <a class="swiper-slide single-slider" href="<?php echo $link; ?>" target="<?php echo $target; ?>" style="background-image: url('<?php echo get_the_post_thumbnail_url() ?>')">
                    <div class="single-slider_content">
                      <div class="category" data-swiper-parallax="-600"><?php echo get_field("category"); ?></div>
                      <div class="title" data-swiper-parallax="-1800">
                        <h1 class="title"><?php the_title() ?></h1>
                      </div>
                      <div class="descr text-big" data-swiper-parallax="-2700"><?php the_content() ?></div>
                    </div></a><?php endforeach;
                  endif;
                  ?>
                  
                </div>
                <div class="swiper-pagination"></div>
              </div>
            </div>
            <div class="col-xxl-3 col-lg-4">
              <div class="side-news">
                <div class="title">Новости</div>
                <?php
                	$arg = array(
                    'category'=> 1,
                    'orderby' => 'date',
                    'numberposts' => 3,
                  );
                 
                $posts = get_posts($arg);
                if ($posts) :
                foreach ($posts as $post) :
                setup_postdata($post);
                ?>
                <a class="single-news" href="<?php the_permalink() ?>">
                  <div class="trumb"><img src="<?php echo get_the_post_thumbnail_url() ?>"/></div>
                  <div class="descr">
                    <div class="title">
                       <?php the_title(); ?></div>
                    <div class="date"><?php the_time('j F Y'); ?></div>
                  </div></a><?php endforeach;
                endif;
                ?>
                
                <div class="more"><a href="/about-us#about_news">Больше новостей</a></div>
              </div>
            </div>
          </div>
        </section>
        <section class="container mob-menu-on-main">
          <div class="row">
            <div class="col-12">
              <ul>
                <li><a href="/product">Продукция</a></li>
                <li><a href="/solutions">Решения</a></li>
                <li><a href="/brands">Бренды</a></li>
                <li><a href="/consolidation">Консолидация</a></li>
                <li><a href="/support">Поддержка</a></li>
                <li><a href="/about-us">О нас</a></li>
              </ul>
            </div>
          </div>
        </section>
        <section class="container">
          <div class="row">
            <div class="col-12 main-page_middle">
              <div class="sidebar">
                <div class="menu-manufacturers_wrapper">
                  <div class="menu-manufacturers swiper-container">
                    <ul class="swiper-wrapper">
                      <li hidden="hidden"></li><?php
                      $product_cat = get_terms('product_cat', 'parent=22&orderby=ID&hide_empty=0');
                      	if($product_cat) :
                      foreach ($product_cat as $cat) :
                      ?>
                      <li class="swiper-slide manufacturer" data-open="false"><a class="js-menu-click" href="<?php echo "/brands#" . $cat->slug; ?>"><img class="icon" src="<?php echo get_field("icon", "product_cat_" . $cat->term_id); ?>"/><img class="logo" src="<?php echo get_field("logo", "product_cat_" . $cat->term_id); ?>"/></a></li><?php
                      	endforeach;
                      	endif;
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="right-content">
                <div class="row products-1-lev"><?php get_new_WC_cards(55, 'product_1lev_card'); ?></div>
              </div>
            </div>
          </div>
        </section>
        <section class="container main-page_bot">
          <div class="row">
            <div class="col-12">
              <h3>Решения</h3>
            </div>
          </div>
          <div class="row solutions">
            <div class="swiper-container solutions-slider">
              <div class="swiper-wrapper">
                
                <?php
                $product_cat = get_terms('product_cat', 'parent=25&orderby=ID&hide_empty=0');
                	if($product_cat) :
                foreach ($product_cat as $cat) :
                ?>
                <div class="swiper-slide col-xl-3 col-md-4 col-10"><a class="solution-card" href="<?php echo "/solutions#" . $cat->slug; ?>">
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
            </div>
          </div>
        </section>
      </div>
    </div>
    <?php get_footer('', 'white'); ?>
  </body>
</html>