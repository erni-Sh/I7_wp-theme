<!DOCTYPE html(lang="ru")>
<html>
  
  <?php get_header(); ?>
  <body>
    <div class="wrapper">
      
      <?php include get_template_directory() . "/sections/section-header.php" ?>
      
      <div class="pagecontent">
        <section class="container page-search">
          <div class="count-results">
            <div class="row">
              <div class="col-12"></div>
            </div>
          </div>
        </section>
        <section class="container page-search">
          <div class="row">
            <div class="col-12 page-search_results">
              <div class="tabs">
                <div class="tab js-active">Продукция</div>
              </div>
            </div>
          </div>
        </section>
        <section class="container page-search">
          <div class="row tabs-contents">
            <div class="col-12">
              <div class="tab-content tab-goods js-active js-menu-pages">
                <div class="products-list">
                  	<?php 
                  if($post) :
                  get_template_part('elements/template_product_card');
                  endif; ?>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <?php get_footer('', 'white'); ?>
  </body>
</html>