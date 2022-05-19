<!DOCTYPE html(lang="ru")>
<html>
  
  <?php get_header(); ?>
  <body>
    <div class="wrapper">
      
      <?php include get_template_directory() . "/sections/section-header.php" ?>
      
      <div class="pagecontent">
        <section class="container">
          <div class="row">
            <div class="col-12">
              <div class="woocommerce-notices-wrapper">	<?php wc_print_notices(); ?></div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              
              <?php if (have_posts()) : 
              	while (have_posts()) : the_post(); ?> 
              
              <?php the_content() ?>
              
              <?php endwhile; 
              endif;  ?>
            </div>
          </div>
        </section>
      </div>
    </div>
    <?php get_footer('', 'white'); ?>
  </body>
</html>