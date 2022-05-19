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
              <div class="top-title" style="background-image: linear-gradient(90deg, rgba(0,0,0,0.65) 50%, rgba(0,0,0,0.65) 100%), url('<?php echo get_template_directory_uri(); ?>/img/backgrounds/Konsolidaciya.jpg')">
                <h1>Консолидация</h1>
                <div class="text-big"><?php echo category_description(36); ?></div>
              </div>
            </div>
          </div>
        </section>
        <section class="container page_bottom js-card-menu-container">
          <div class="row page-brand solutions">
            <?php $sub_cats = get_categories( array('child_of' => 36, 'hide_empty' => 0) ); ?>
            
            <?php if( $sub_cats ):
            	foreach( $sub_cats as $cat ) : ?>
            
            
            <?php $arg = array(
              'category'=> $cat->term_id,
              'orderby' => 'date',
              'numberposts' => 1,
            );
             
            $posts = get_posts($arg);
            if ($posts) :
            foreach ($posts as $post) :
            setup_postdata($post);
            ?>
            
            <div class="col-xl-3 col-md-4"><a class="solution-card" href="<?php echo "#" . $cat->slug . "_" . $post->post_name ?>" style="background-color: #BE1D25">
                <div class="solution-card_inner">
                  <div class="solution-card_trumb"><img src="<?php echo get_field("category-trumb", "category_" . $cat->term_id) ?>"/></div>
                  <div class="solution-card_title">
                    <h5><?php echo $cat->name ?></h5>
                  </div>
                </div></a></div><?php endforeach;
            endif; ?>
            
            <?php 
            endforeach;
            endif;
            ?>
          </div>
        </section>
        <section class="container js-card-menu-inside-container page-consolidation">
          <div class="row">
            <div class="col-12 page_middle">
              <div class="sidebar">
                
                <?php 
                if( $sub_cats ):
                	foreach( $sub_cats as $cat ) : 
                ?>
                
                <div class="side-menu is-hidden">
                  <div class="title"><?php echo $cat->name ?></div>
                  <div class="menu-wrapper">
                    
                    <?php
                    	$arg = array(
                        'category'=> $cat->term_id,
                        'orderby' => 'date',
                        'numberposts' => 10,
                      );
                     
                    $posts = get_posts($arg);
                    if ($posts) : ?>
                    <ul>
                      
                      <?php
                      foreach ($posts as $post) :
                      setup_postdata($post);
                      ?>
                      
                      <li class="menu-item"><a class="title" href="<?php echo "#" . $cat->slug . "_" . $post->post_name ?>"><?php the_title() ?>					</a></li><?php endforeach;
                      endif;
                      ?>
                      
                    </ul>
                  </div>
                </div><?php 
                endforeach;
                endif;
                ?>
              </div>
              <div class="right-content">
                
                <?php 
                if( $sub_cats ):
                	foreach( $sub_cats as $cat ) : 
                ?>
                
                
                <?php
                	$arg = array(
                    'category'=> $cat->term_id,
                    'orderby' => 'date',
                    'numberposts' => 10,
                  );
                 
                $posts = get_posts($arg);
                if ($posts) : ?>
                
                <?php
                foreach ($posts as $post) :
                setup_postdata($post);
                ?>
                
                <div class="js-menu-pages" data-page="<?php echo $cat->slug . "_" . $post->post_name ?>" data-title="<?php the_title() ?>">
                  <div class="article_trumb"> <img src="<?php echo get_the_post_thumbnail_url() ?>"/></div>
                  <div class="article"><?php the_content() ?>
                    <button class="js-popUp-open">Направить запрос</button>
                  </div>
                </div><?php endforeach;
                endif;
                ?>
                
                <?php 
                endforeach;
                endif;
                ?>
              </div>
            </div>
          </div>
        </section>
        <section class="popUp" id="popUp">
          <div class="popUp_wrapper">
            <div class="popUp_inner">
              <div class="popUp-form">
                <form class="form">
                  <div class="popUp-form_title">Связаться с нами</div>
                  <div class="popUp-form_descr">Наши эксперты ответят вам, как только обработают ваше сообщение.</div>
                  <div class="pos-rel">
                    <input class="form__inputs name" name="name" placeholder="" required="required"/>
                    <label class="form__label">Ваше имя</label>
                    <div class="error">Напишите свое имя</div>
                  </div>
                  <div class="pos-rel">
                    <input class="form__inputs e-mail" name="email" placeholder="" required="required"/>
                    <label class="form__label">Ваш email</label>
                    <div class="error">Напишите ваш email</div>
                  </div>
                  <div class="pos-rel">
                    <textarea class="textarea form__inputs name" name="message" placeholder="" required="required"></textarea>
                    <label class="form__label">Ваше сообщение</label>
                  </div>
                  <div class="form__agree">
                    <input class="agree form__checkbox" type="checkbox"/>
                    <label for="argee">соглашаюсь с условиями <a href="/docs" target="_blank">Политики конфиденциальности </a></label>
                    <div class="error">Подтвердите свое согласие</div>
                  </div>
                  <div class="form__btn">
                    <button class="submit"><b>Направить запрос</b></button>
                  </div>
                </form>
                <div class="form_send-success"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/send-ok.png"/>
                  <div class="title">Ваше сообщение отправлено</div>
                  <div class="descr">Наши эксперты ответят вам, как только обработают ваше сообщение.</div>
                  <button class="btn js-return-form popUp_close">Хорошо</button>
                </div>
                <div class="form_send-error"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/send-ok.png"/>
                  <div class="title">Ваше сообщение не отправлено</div>
                  <div class="descr">Что-то пошло не так, повторите попытку.</div>
                  <button class="btn js-return-form">Повторить</button>
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