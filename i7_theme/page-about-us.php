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
              <div class="top-title" style="background-image: linear-gradient(90deg, rgba(0,0,0,0.65) 50%, rgba(0,0,0,0.65) 100%), url('<?php echo get_template_directory_uri(); ?>/img/backgrounds/Onas.jpg')">
                <h1>И7</h1>
                <div class="text-big"><?php echo category_description(28); ?></div>
              </div>
            </div>
          </div>
        </section>
        <section class="container">
          <div class="row">
            <div class="col-12 page_middle">
              <div class="sidebar">
                <div class="side-menu">
                  <div class="menu-wrapper">
                    <ul>
                      <li class="menu-item"><a class="title" href="#about_us">О нас</a></li>
                      <li class="menu-item"><a class="title" href="#about_news">Новости</a></li>
                      <li class="menu-item"><a class="title" href="#responsible_business">Ответственный бизнес</a></li>
                      <li class="menu-item"><a class="title" href="#history">История</a></li>
                      <li class="menu-item"><a class="title" href="#agency">Представительства</a></li>
                      <li class="menu-item"><a class="title" href="#contacts">Контакты																																													</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="right-content">
                <div class="js-menu-pages" data-page="about_us" data-title="И7">
                  <div class="article">
                    <?php $post = get_post(73);
                    echo $post->post_content; ?>						
                  </div>
                </div>
                <div class="js-menu-pages" data-page="about_news" data-title="Новости">
                  <div class="about-news"><?php get_new_cards(1); ?></div>
                  <div class="row">
                    <div class="col-12 text-center">
                      
                      <?php $max_pages = get_max_pages_on_category('1', '4'); ?>
                      <?php if($max_pages > 1) : ?>
                      <button class="btn_white loader_new_cards" data-page="2" data-category="1" data-container=".about-news" data-maxpage="<?php echo $max_pages ?>"> <span>Показать еще</span></button><?php endif ?>
                      
                    </div>
                  </div>
                </div>
                <div class="js-menu-pages" data-page="responsible_business" data-title="Отвественный бизнес">
                  <div class="article">
                    <?php $post = get_post(75);
                    echo $post->post_content; ?>																																				
                  </div>
                </div>
                <div class="js-menu-pages" data-page="history" data-title="История">
                  <div class="article">
                    <?php $post = get_post(77);
                    echo $post->post_content; ?>																				
                  </div>
                </div>
                <div class="js-menu-pages" data-page="agency" data-title="Представительства">
                  <div class="agency">
                    <?php $post = get_post(79);
                    echo $post->post_content; ?>		
                  </div>
                </div>
                <div class="js-menu-pages" data-page="contacts" data-title="Контакты">
                  <div class="row contacts">
                    <div class="col-lg-4">
                      <div class="contacts_small-cards gray-card">
                        <h6 class="title">Позвоните нам</h6>
                        <p><b>Телефон: </b><?php echo get_field('phone', 5857); ?></p>
                        <p>Мы ответим на все интересующие Вас вопросы.</p><a class="icon" href="tel:<?php echo get_field('phone', 5857); ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/call_us.svg"/></a>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="contacts_small-cards gray-card">
                        <h6 class="title">Напишите нам</h6>
                        <p><b>Почта: </b><a href="mailto:<?php echo get_field('e-mail', 5857) ?>"><?php echo get_field('e-mail', 5857); ?>										</a></p>
                        <p>Мы постраемся оперативно ответить на Ваше сообщение.</p><a class="icon" href="mailto:<?php echo get_field('e-mail', 5857) ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/write_us.svg"/></a>
                      </div>
                    </div>
                    <div class="col-lg-4">
                      <div class="contacts_small-cards gray-card">
                        <h6 class="title">Онлайн чат</h6>
                        <p>Нажмите на кнопку, чтобы начать общение или отправьте сообщение TELEGRAM / WHATSApp +7&nbsp;(903)&nbsp;960&#8209;37&#8209;64</p><a class="icon" href="/about-us#contacts" onclick="tidioChatApi.open()"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/chat.svg"/></a>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="contacts_big-cards contacts_yandex gray-card"><a href="https://yandex.ru/maps/org/i7/1315719161/?utm_medium=mapframe&amp;utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:0px;">И7</a><a href="https://yandex.ru/maps/213/moscow/category/hydraulic_and_pneumatic_equipment/184106510/?utm_medium=mapframe&amp;utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:14px;">Гидравлическое и пневматическое оборудование в Москве</a><a href="https://yandex.ru/maps/213/moscow/category/industrial_equipment/184106862/?utm_medium=mapframe&amp;utm_source=maps" style="color:#eee;font-size:12px;position:absolute;top:28px;">Промышленное оборудование в Москве</a>
                        <iframe src="https://yandex.ru/map-widget/v1/-/CCUuF8uBcC" width="560" height="400" frameborder="1" allowfullscreen="true" style="position:relative;"></iframe>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="contacts_big-cards gray-card">
                        <div>
                          <h4 class="title">Офис</h4>
                          <p><b>Адрес: </b><?php echo get_field('office_address_1', 5857);
                            $address = get_field('office_address_2', 5857);
                            if($address) echo '<br>' . $address;
                            $address = get_field('office_address_3', 5857);
                            if($address) echo '<br>' . $address; ?>									
                          </p>
                          <p><b>Время работы: </b><?php echo get_field('office_schedule_time', 5857) ?></p>
                        </div>
                        <div>
                          <h4 class="title">Склад</h4>
                          <p><b>Адрес: </b><?php echo get_field('warehouse_address', 5857) ?>										</p>
                          <p><b>Время работы: </b><?php echo get_field('warehouse_schedule_time', 5857) ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
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