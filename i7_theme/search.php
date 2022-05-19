<!DOCTYPE html(lang="ru")>
<html>
  
  <?php get_header(); ?>
  <body>
    <div class="wrapper">
      
      <?php include get_template_directory() . "/sections/section-header.php" ?>
      
      <div class="pagecontent">
        
        <?php
        $s = $_GET['s'];
        if($s) :
        ?>
         
        <?php
        $product_args = array( 
        		'post_type' => 'product', 
        		'product_cat' => 'production', 
        		's' => '"' . $s . '"', 
        		'post_status' => 'publish', 
        		'posts_per_page' => -1,
        		'relevanssi' => true
        );
        $products = new WP_Query( $product_args );
        $found_on_products = $products->found_posts;
        $max_pages = ceil($found_on_products / 10);
        ?>
        
        <?php 
        $found_on_docs = 0;
        $docs_array = [];
        while ( $products->have_posts()) :
        	$products->the_post();
        	$tech_link = basename(get_field("tech-link"));
        	 	$finded = stripos($tech_link, $s);
        	if(strlen($finded)):
        		if(!in_array($tech_link, $docs_array)) :
        			$docs_array[$found_on_docs] = $tech_link;
        			$found_on_docs++;
        		endif;
        	endif;
        endwhile;
        ?>
        <?php
        $site_args = array(
        		'post_type' => 'post',
        		's' => $s,
        		'post_status' => 'publish',
        		'posts_per_page' => 20,
        		'relevanssi' => true
        );	
        $site = new WP_Query( $site_args );
        $found_on_site = $site->found_posts;
        ?>
        
        <?php 
        else :
        $found_on_products = 0;
        $found_on_docs = 0;
        $found_on_site = 0;
        endif;
        ?>
        <section class="container page-search">
          <div class="count-results">
            <div class="row">
              <?php
              if(!$s): ?>
              <div class="col-12">Введите поисковый запрос</div><?php else :
              $founded_total = $found_on_products + $found_on_docs + $found_on_site;
              if($founded_total) :
              $word_result = 'результатов';
              $word_finded = 'найдено';
              if(!($founded_total > 10 && $founded_total < 20)):
              $var = $founded_total % 10;
              if( $var == 2 || $var == 3 || $var == 4) $word_result = 'результата';
              if( $var == 1) : 
              		$word_result = 'результат';
              		$word_finded = 'найден';
              endif;
              endif;
              ?>
              <div class="col-12">По запросу «<?php echo $s;?>» <?php echo $word_finded . ': ' . $founded_total . ' ' . $word_result; ?></div><?php else: ?>
              <div class="col-12">По вашему запросу «<?php echo $s;?>» ничего не найдено.</div><?php endif;
              endif; ?>
            </div>
          </div>
        </section>
        <section class="container page-search">
          <div class="row">
            <div class="col-12 page-search_results">
              <div class="tabs">
                <div class="tab js-active">Продукция(<?php echo $found_on_products; ?>)</div>
                <div class="tab">Документация(<?php echo $found_on_docs; ?>)</div>
                <div class="tab">Сайт(<?php echo $found_on_site ?>)</div>
              </div>
            </div>
          </div>
        </section>
        <section class="container page-search">
          <div class="row tabs-contents">
            
            <?php if($s) : ?>
            
            <div class="col-12">
              <div class="tab-content tab-goods js-active js-menu-pages">
                
                <?php if($found_on_products) : ?>
                
                <div class="products-list">
                   
                  <?php get_new_cards('production', null, '"' . $s . '"'); ?>
                  
                </div>
                <div class="row">
                  <div class="col-12 text-center">
                    
                    <?php if($max_pages > 1) : ?>
                    
                    <button class="btn_white js-loader loader_new_cards" data-page="2" data-category="production" data-search="<?php echo $s ?>" data-container=".products-list" data-maxpage="<?php echo $max_pages ?>"> <span>Показать еще</span></button>
                    <div class="lds-facebook">
                      <div></div>
                      <div></div>
                      <div></div>
                    </div>
                    <?php endif ?>
                    
                  </div>
                </div>
                <?php else : ?>
                
                <div class="article">
                  <P> <b>Повторите поиск или направьте нам запрос</b></P>
                  <button class="js-popUp-open">Направить запрос</button>
                </div>
                <?php endif; ?>
                
              </div>
              <div class="tab-content tab-docs">
                
                <?php if($found_on_docs) : ?>
                <?php 
                foreach ($docs_array as $doc_item) :
                ?>
                <div class="tab-docs_item">
                  <div class="tab-docs_item-trumb"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/pdf-icon.svg"/></div>
                  <div class="tab-docs_item-name"> <a href="<?php echo get_site_url() . "/wc-products-import/" . $doc_item; ?>" target="_blank"><?php echo $doc_item; ?></a></div>
                </div>
                <?php 
                endforeach;
                else : ?>
                
                <div class="article">
                  <P> <b>Повторите поиск или направьте нам запрос</b></P>
                  <button class="js-popUp-open">Направить запрос</button>
                </div>
                <?php endif; ?>
                
              </div>
              <div class="tab-content tab-site">
                
                <?php if($found_on_site) :
                while ( $site->have_posts()) :
                $site->the_post();
                ?>
                
                <div class="tab-site_item">
                  <h5 class="tab-site_title"><a href="<?php the_permalink();?>">
                      
                      	<?php 
                      $title = $post->post_title;
                      	echo $title;  
                      	?> 
                      	</a></h5>
                  <div class="tab-site_excerpt">
                    <?php  
                    $excerpt = $post->post_excerpt;  
                    echo '<p>', $excerpt, '</p>';  
                    ?>
                    
                  </div>
                </div>
                <?php endwhile; ?>
                
                
                <?php else : ?>
                
                <div class="article">
                  <P> <b>Повторите поиск или направьте нам запрос</b></P>
                  <button class="js-popUp-open">Направить запрос</button>
                </div>
                <?php endif; ?>
                
              </div>
            </div>
            <?php endif; ?>
            
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