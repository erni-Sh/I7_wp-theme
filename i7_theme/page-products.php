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
              <div class="top-title" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/backgrounds/top-background_1.jpg')">
                <div class="title-wrap">
                  <h1>Продукция</h1>
                </div>
                <div class="text-big"><?php echo category_description(55); ?></div>
              </div>
            </div>
          </div>
        </section>
        <section class="container">
          <div class="row">
            <div class="col-12 page_middle">
              <div class="sidebar">
                <div class="side-dropdown-menu"><a class="title js-scrollUp" href="#!">Продукция</a>
                  <div class="menu-1-lev">
                    <ul>
                      <li class="hidden"></li>
                      <?php 
                      function render_products_menu_items($products_cat) {
                      foreach ($products_cat as $product_cat) :
                      ?>
                      
                      <?php
                      $product_cat_nested = get_terms( array(
                      	'taxonomy' => 'product_cat',
                      	'parent' => $product_cat->term_id,
                      	'orderby' => 'term_order',
                      	'hide_empty' => 0
                      ));
                      if($product_cat_nested) : ?>
                      <li><a class="title" href="<?php echo "#" . $product_cat->slug; ?>"><?php echo $product_cat->name; ?></a>
                        <div class="menu-nested">
                          <ul><?php render_products_menu_items($product_cat_nested) ?></ul>
                        </div>
                      </li><?php else: ?>
                      <li class="last-nesting js-scrollUp"><a class="title" href="<?php echo "#" . $product_cat->slug; ?>"><?php echo $product_cat->name; ?></a></li><?php 
                      endif; ?>
                      <?php
                      endforeach;
                      }; ?>
                      
                      <?php
                      $product_cat_1lev = get_terms('product_cat', 'parent=55&orderby=ID&hide_empty=0');
                      if($product_cat_1lev) render_products_menu_items($product_cat_1lev);
                      ?>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="right-content">
                <div class="js-menu-pages" data-page="">
                  <div class="row products-1-lev"><?php get_new_WC_cards(55, 'product_1lev_card'); ?></div>
                </div>
                <?php 
                function render_products_cat_cards($products_cat) {
                foreach ($products_cat as $product_cat) : ?>
                
                <div class="js-menu-pages" data-page="<?php echo $product_cat->slug ?>">
                  <div class="row products-2-lev"><?php get_new_WC_cards($product_cat->term_id, 'product_23lev_card'); ?></div>
                </div>
                <?php 
                $product_cat_nested = get_terms( array(
                	'taxonomy' => 'product_cat',
                	'parent' => $product_cat->term_id,
                	'orderby' => 'term_order',
                	'hide_empty' => 0
                ));
                if($product_cat_nested) :
                	render_products_cat_cards($product_cat_nested);
                else : ?>
                
                <div class="js-menu-pages" data-page="<?php echo $product_cat->slug ?>"><?php include (TEMPLATEPATH . '/elements/template_products_list.php'); ?></div>
                <?php
                endif;
                endforeach;
                ?>
                <?php };
                if($product_cat_1lev) render_products_cat_cards($product_cat_1lev);
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