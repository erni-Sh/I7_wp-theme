<!DOCTYPE html(lang="ru")>
<html>
  
  <?php get_header(); ?>
  <body>
    <div class="wrapper">
      
      <?php include get_template_directory() . "/sections/section-header.php" ?>
      
      <div class="pagecontent">
        <section class="container">
          <div class="row">
            <div class="col-12 news-inside page-bottom">
              <div class="title"><?php the_title() ?></div>
              <div class="date"><?php the_time('j/m/Y'); ?></div>
              <div class="trumb"><img src="<?php echo get_the_post_thumbnail_url() ?>;"/></div>
              <div class="content"><?php the_content() ?></div>
            </div>
          </div>
        </section>
      </div>
    </div>
    <?php get_footer('', 'white'); ?>
  </body>
</html>