
<div class="col-xl-6"><a class="about-news_card" href="<?php the_permalink() ?>">
    <div class="about-news_trumb"><img src="<?php echo get_the_post_thumbnail_url() ?>;"/></div>
    <div class="about-news_descr">
      <div class="about-news_title"><?php the_title(); ?></div>
      <div class="about-news_exept"><?php the_excerpt() ?></div>
      <div class="about-news_date"><?php the_time('j/m/Y'); ?></div>
    </div></a></div>