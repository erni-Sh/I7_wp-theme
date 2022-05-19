<!DOCTYPE html(lang="ru")>
<html>
  
  <?php get_header(); ?>
  <body>
    <div class="wrapper">
      
      <?php include get_template_directory() . "/sections/section-header.php" ?>
      
      <div class="pagecontent">
        <div class="woocommerce-notices-wrapper"><?php wc_print_notices(); ?></div>
        <section class="container">
          <div class="row">
            <div class="col-12"><?php echo do_shortcode('[products]'); ?></div>
          </div>
        </section>
      </div>
    </div>
    <?php get_footer('', 'white'); ?>
  </body>
</html>