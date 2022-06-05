
<footer class="container s-footer">
  <div class="row s-footer_r1">
    <div class="col-lg-7">
      <form class="s-footer_search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <p> <b>Поиск по сайту</b></p>
        <div class="input">
          <input type="text" name="s" placeholder="Поиск" value="<?php if(!empty($_GET['s'])){echo $_GET['s'];}?>" autocomplete="off"/>
          <button class="s-footer_search-icon" type="submit"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/search-black.svg"/></button>
        </div>
        <input class="btn" type="submit" value="Найти"/>
      </form>
    </div>
    <div class="col-lg-5">
      <div class="s-footer_contacts">
        <div class="s-footer_mail"><a href="mailto:info@iseven.ru"><b>info@iseven.ru</b></a></div>
        <div class="s-footer_phone"><a href="tel:+74957781732"><b>+7 (495) 778 17 32</b></a></div>
      </div>
    </div>
  </div>
  <div class="row s-footer_r2 s-footer_menu">
    <div class="col-md-3">
      <?php
      $category = 25;
      $page = 9;
      $sub_cats = get_terms('product_cat',[
      		'parent' => $category,
      		'orderby' => 'ID',
      		'hide_empty' => 0
      ]);
      	?>
       
      <h6 class="h6"><a href="<?php echo get_permalink($page)  . "#"; ?>"><?php echo get_the_title($page); ?></a></h6>
      <ul>
        
        <?php
        $counter = 0;
        if( $sub_cats ):
        	foreach( $sub_cats as $cat ) :
        if($counter < 5) :
        ?>
        
        <li> <a href="<?php echo get_permalink($page) . "#" . $cat->slug; ?>"><?php echo $cat->name; ?></a></li><?php
        $counter ++;
        endif;
        endforeach;
        endif;
        ?>
      </ul>
    </div>
    <div class="col-md-2">
      <h6 class="h6"><a href="/about-us">О нас</a></h6>
      <ul>
        <li> <a href="/about-us#about_news">Новости</a></li>
        <li> <a href="/about-us#responsible_business">Ответственный бизнес</a></li>
        <li> <a href="/about-us#history">История</a></li>
        <li> <a href="/about-us#agency">Представительства</a></li>
        <li> <a href="/about-us#contacts">Контакты</a></li>
      </ul>
    </div>
    <div class="col-lg-3 col-md-2">
      <?php
      $sub_catss = get_categories( array(
      	'parent' => 32,
      	'hide_empty' => 0
      ) );
      $link = '/support';
      	?>
      <h6 class="h6"><a href="<?php echo $link ?>">Поддержка</a></h6>
      <ul>
        
        <?php 
        if( $sub_catss ):
        	foreach( $sub_catss as $cat ) : 
        ?>
        
        <li> <a href="<?php echo $link . "#" . $cat->slug ?>"><?php echo $cat->name ?></a></li><?php 
        endforeach;
        endif;
        ?>
      </ul>
    </div>
    <div class="col-lg-4 col-md-5 col-12 s-footer_form">
      <form class="form">
        <div class="form_top-text">
          <p>Появились вопросы? Напишите нам.</p>
        </div>
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
          <div class="error">Напишите сообщение</div>
        </div>
        <div class="form__agree">
          <input class="agree form__checkbox" type="checkbox"/>
          <label for="argee">соглашаюсь с условиями <a class="l-underline" href="/docs" target="_blank">Политики&nbsp;конфиденциальности </a></label>
          <div class="error">Подтвердите свое согласие</div>
        </div>
        <div class="form__btn">
          <button class="submit"><b>ОТПРАВИТЬ</b></button>
        </div>
      </form>
      <div class="form_send-success">
        <div class="form_send-inner">Письмо успешно отправлено!</div>
      </div>
      <div class="form_send-error">
        <div class="form_send-inner">Письмо не отправлено...
          <button class="btn_white js-return-form"><b>Повторить</b></button>
        </div>
      </div>
    </div>
  </div>
  <div class="row s-footer_r3">
    <div class="col-lg-6">
      <div class="s-footer_slogan">
        <p>Все для управления <br/>потоками и процессами</p>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="s-footer_docs">
        <ul>
          <li><a href="/terms-of-use">Условия использования</a></li>
          <li><a href="/privacy-policy">Политика конфиденциальности</a></li>
          <li><a href="/policy-use-cookies">Cookies</a></li>
        </ul>
      </div>
      <div class="s-footer_copyright">
        <p>© 2007-<span id="year"></span> г. Компания И7. Все&nbsp;права&nbsp;защищены</p>
      </div>
    </div>
  </div><a class="js-logo" href="https://jscorp.ru/" target="_blank"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/js-logo.png"/></a>
</footer><?php wp_footer() ?>