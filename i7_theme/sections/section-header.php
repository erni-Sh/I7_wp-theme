
<header class="s-header">
  <div class="hamburger_toogle"><span></span><span></span><span></span></div>
  <div class="hamburger">
    <div class="hamburger_wrap">
      <div class="hamburger_menu">
        <ul>
          <li><a href="/products">Продукция</a></li>
          <li><a href="/solutions">Решения</a></li>
          <li><a href="/brands">Бренды</a></li>
          <li><a href="/consolidation">Консолидация</a></li>
          <li><a href="/support">Поддержка</a></li>
          <li><a href="/about-us">О нас</a></li>
        </ul>
      </div>
      <div class="hamburger_contacts">
        <div class="hamburger_mail"><a href="mailto:info@iseven.ru">info@iseven.ru</a></div>
        <div class="hamburger_phone"><a href="tel:+74957781732">+7 (495) 778 17 32</a></div>
      </div>
    </div>
  </div>
  <div class="s-header_r1">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="s-header_logo"><a href="/"><img src="<?php echo get_template_directory_uri(); ?>/img/favicon/I7_logo.svg"/></a></div>
        </div>
        <div class="col-md-10 text-right">
          <div class="s-header_r1c2">
            <div class="s-header_mail"><a href="mailto:info@iseven.ru">info@iseven.ru</a></div>
            <div class="s-header_phone"><a href="tel:+74957781732">+7 (495) 778 17 32</a></div>
            <div class="s-header_search">
                            <form class="search_form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                              <input type="text" name="s" placeholder="Поиск" value="<?php if(!empty($_GET['s'])){echo $_GET['s'];}?>" autocomplete="off"/>
                              <div class="lds-dual-ring is-hidden"></div>
                              <button class="search-icon" type="submit"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/search-gray.svg"/></button>
                              <div class="search_wrapper" style="display: none">
                                <ul></ul>
                                <button type="submit">Показать больше результатов</button>
                              </div>
                            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="s-header_search mobile">
                  <form class="search_form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text" name="s" placeholder="Поиск" value="<?php if(!empty($_GET['s'])){echo $_GET['s'];}?>" autocomplete="off"/>
                    <div class="lds-dual-ring is-hidden"></div>
                    <button class="search-icon" type="submit"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/search-gray.svg"/></button>
                    <div class="search_wrapper" style="display: none">
                      <ul></ul>
                      <button type="submit">Показать больше результатов</button>
                    </div>
                  </form>
  </div>
  <div class="s-header_r2">
    <div class="container">
      <div class="row pos-rel">
        <div class="col-lg-8">
          <nav class="nav t-menu">
            <ul class="t-menu_list">
              
              <?php 
              $classActivePage = '';
              $classScroll = '';
              if(is_page(21)) :
              $classActivePage = 'js-active-page';
              $classScroll = 'js-scrollUp';
              endif; ?>
              
              <li class="t-menu_item has-dropdown <?php echo $classActivePage; ?>">
                <?php
                $category = 55;
                $page_id = 21;
                $sub_cats = get_terms('product_cat',[
                		'parent' => $category,
                		'orderby' => 'ID',
                		'hide_empty' => 0
                ]);
                	?>
                 <a href="<?php echo get_permalink($page_id)  . "#"; ?>"><?php echo get_the_title($page_id); ?></a>
                <div class="drop-down container">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                      <div class="drop-down_menu">
                         
                        <?php if( $sub_cats ): ?>
                        <?php
                        $mid_count = count($sub_cats) / 2;
                        if($mid_count < 4) $mid_count = 8;
                        $counter = 0;
                        ?>
                        <div class="drop-down_list">
                          <ul>
                            <?php
                            	foreach( $sub_cats as $cat ) :
                            if($counter < $mid_count) :
                            ?>
                            
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id) . "#" . $cat->slug; ?>"><?php echo $cat->name; ?></a></li><?php
                            $counter++;
                            endif;
                            endforeach; ?>
                          </ul>
                        </div>
                        <div class="drop-down_list">
                          <ul>
                            <?php
                            $sub_cats = array_splice($sub_cats, ceil($mid_count));
                            	foreach( $sub_cats as $cat ) :
                            ?>
                            
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id) . "#" . $cat->slug; ?>"><?php echo $cat->name; ?></a></li><?php
                            endforeach; ?>
                          </ul>
                        </div> 
                        <?php endif; ?>
                      </div>
                      <div class="drop-down_descr">
                        <h4><?php echo get_the_title($page_id); ?></h4><?php echo get_the_content( null, false, $page_id); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <?php 
              $classActivePage = '';
              $classScroll = '';
              if(is_page(9)) :
              $classActivePage = 'js-active-page';
              $classScroll = 'js-scrollUp';
              endif; ?>
              
              <li class="t-menu_item has-dropdown <?php echo $classActivePage; ?>">
                <?php
                $category = 25;
                $page_id = 9;
                $sub_cats = get_terms('product_cat',[
                		'parent' => $category,
                		'orderby' => 'ID',
                		'hide_empty' => 0
                ]);
                	?>
                 <a href="<?php echo get_permalink($page_id)  . "#"; ?>"><?php echo get_the_title($page_id); ?></a>
                <div class="drop-down container">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                      <div class="drop-down_menu">
                         
                        <?php if( $sub_cats ): ?>
                        <?php
                        $mid_count = count($sub_cats) / 2;
                        if($mid_count < 4) $mid_count = 8;
                        $counter = 0;
                        ?>
                        <div class="drop-down_list">
                          <ul>
                            <?php
                            	foreach( $sub_cats as $cat ) :
                            if($counter < $mid_count) :
                            ?>
                            
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id) . "#" . $cat->slug; ?>"><?php echo $cat->name; ?></a></li><?php
                            $counter++;
                            endif;
                            endforeach; ?>
                          </ul>
                        </div>
                        <div class="drop-down_list">
                          <ul>
                            <?php
                            $sub_cats = array_splice($sub_cats, ceil($mid_count));
                            	foreach( $sub_cats as $cat ) :
                            ?>
                            
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id) . "#" . $cat->slug; ?>"><?php echo $cat->name; ?></a></li><?php
                            endforeach; ?>
                          </ul>
                        </div> 
                        <?php endif; ?>
                      </div>
                      <div class="drop-down_descr">
                        <h4><?php echo get_the_title($page_id); ?></h4><?php echo get_the_content( null, false, $page_id); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <?php 
              $classActivePage = '';
              $classScroll = '';
              if(is_page(13)) :
              $classActivePage = 'js-active-page';
              $classScroll = 'js-scrollUp';
              endif; ?>
              
              <li class="t-menu_item has-dropdown <?php echo $classActivePage; ?>">
                <?php
                $category = 22;
                $page_id = 13;
                $sub_cats = get_terms('product_cat',[
                		'parent' => $category,
                		'orderby' => 'ID',
                		'hide_empty' => 0
                ]);
                	?>
                 <a href="<?php echo get_permalink($page_id)  . "#"; ?>"><?php echo get_the_title($page_id); ?></a>
                <div class="drop-down container">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                      <div class="drop-down_menu">
                         
                        <?php if( $sub_cats ): ?>
                        <?php
                        $mid_count = count($sub_cats) / 2;
                        if($mid_count < 4) $mid_count = 8;
                        $counter = 0;
                        ?>
                        <div class="drop-down_list">
                          <ul>
                            <?php
                            	foreach( $sub_cats as $cat ) :
                            if($counter < $mid_count) :
                            ?>
                            
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id) . "#" . $cat->slug; ?>"><?php echo $cat->name; ?></a></li><?php
                            $counter++;
                            endif;
                            endforeach; ?>
                          </ul>
                        </div>
                        <div class="drop-down_list">
                          <ul>
                            <?php
                            $sub_cats = array_splice($sub_cats, ceil($mid_count));
                            	foreach( $sub_cats as $cat ) :
                            ?>
                            
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id) . "#" . $cat->slug; ?>"><?php echo $cat->name; ?></a></li><?php
                            endforeach; ?>
                          </ul>
                        </div> 
                        <?php endif; ?>
                      </div>
                      <div class="drop-down_descr">
                        <h4><?php echo get_the_title($page_id); ?></h4><?php echo get_the_content( null, false, $page_id); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <?php 
              $classActivePage = '';
              $classScroll = '';
              if(is_page(11)) :
              $classActivePage = 'js-active-page';
              $classScroll = 'js-scrollUp';
              endif; ?>
              
              <li class="t-menu_item has-dropdown <?php echo $classActivePage; ?>">
                <?php
                $category = 36;
                $page_id = 11;
                $sub_cats = get_categories( array(
                	'child_of' => $category,
                	'hide_empty' => 0
                ) );
                	?>
                 <a href="<?php echo get_permalink($page_id)  . "#"; ?>"><?php echo get_the_title($page_id); ?></a>
                <div class="drop-down container">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                      <div class="drop-down_menu">
                         
                        <?php if( $sub_cats ): ?>
                        <?php
                        $mid_count = count($sub_cats) / 2;
                        if($mid_count < 4) $mid_count = 8;
                        $counter = 0;
                        ?>
                        <div class="drop-down_list">
                          <ul>
                            <?php
                            	foreach( $sub_cats as $cat ) :
                            if($counter < $mid_count) :
                            ?>
                            
                            
                            <?php $arg = array(
                              'category'=> $cat->term_id,
                              'orderby' => 'date',
                              'numberposts' => 1,
                            );
                             
                            $posts = get_posts($arg);
                            if ($posts) :
                            foreach ($posts as $post_cur) :
                            ?>
                            	
                            <li><a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id) . "#" . $cat->slug . "_" . $post_cur->post_name; ?>"><?php echo $cat->name; ?></a></li>
                            <?php endforeach;
                            endif;
                            ?>
                            
                            <?php
                            $counter++;
                            endif;
                            endforeach; ?>
                          </ul>
                        </div>
                        <div class="drop-down_list">
                          <ul>
                            <?php
                            $sub_cats = array_splice($sub_cats, ceil($mid_count));
                            	foreach( $sub_cats as $cat ) :
                            ?>
                            
                            <li>
                              
                              <?php $arg = array(
                                'category'=> $cat->term_id,
                                'orderby' => 'date',
                                'numberposts' => 1,
                              );
                               
                              $posts = get_posts($arg);
                              if ($posts) :
                              foreach ($posts as $post_cur) :
                              ?>
                              	<a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id) . "#" . $cat->slug . "_" . $post_cur->post_name; ?>"><?php echo $cat->name; ?></a>
                              <?php endforeach;
                              endif; ?>
                              
                            </li><?php
                            endforeach; ?>
                          </ul>
                        </div> 
                        <?php endif; ?>
                      </div>
                      <div class="drop-down_descr">
                        <h4><?php echo get_the_title($page_id); ?></h4><?php echo get_the_content( null, false, $page_id); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <?php 
              $classActivePage = '';
              $classScroll = '';
              if(is_page(15)) :
              $classActivePage = 'js-active-page';
              $classScroll = 'js-scrollUp';
              endif; ?>
              
              <li class="t-menu_item has-dropdown <?php echo $classActivePage; ?>">
                <?php
                $category = 32;
                $page_id = 15;
                $sub_cats = get_categories( array(
                	'child_of' => $category,
                	'hide_empty' => 0
                ) );
                	?>
                 <a href="<?php echo get_permalink($page_id)  . "#"; ?>"><?php echo get_the_title($page_id); ?></a>
                <div class="drop-down container">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                      <div class="drop-down_menu">
                        <div class="drop-down_list">
                          <ul>
                            
                            <?php 
                            if( $sub_cats ):
                            	foreach( $sub_cats as $cat ) : 
                            ?>
                            
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id) . "#" . $cat->slug; ?>"><?php echo $cat->name; ?></a></li><?php 
                            endforeach;
                            endif;
                            ?>
                          </ul>
                        </div>
                      </div>
                      <div class="drop-down_descr">
                        <h4><?php echo get_the_title($page_id); ?></h4><?php echo get_the_content( null, false, $page_id); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </li><?php 
              $classActivePage = '';
              $classScroll = '';
              if(is_page(17)) :
              $classActivePage = 'js-active-page';
              $classScroll = 'js-scrollUp';
              endif; ?>
              
              <li class="t-menu_item has-dropdown <?php echo $classActivePage; ?>"><?php $page_id = 17; ?><a href="<?php echo get_permalink($page_id)  . "#"; ?>"><?php echo get_the_title($page_id); ?></a>
                <div class="drop-down container">
                  <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                      <div class="drop-down_menu">
                        <div class="drop-down_list">
                          <ul>
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id)  . "#about_us"; ?>">О нас</a></li>
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id)  . "#about_news"; ?>">Новости</a></li>
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id)  . "#responsible_business"; ?>">Ответственный бизнес</a></li>
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id)  . "#history"; ?>">История</a></li>
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id)  . "#agency"; ?>">Представительства</a></li>
                            <li> <a class="<?php echo $classScroll; ?>" href="<?php echo get_permalink($page_id)  . "#contacts"; ?>">Контакты</a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="drop-down_descr">
                        <h4><?php echo get_the_title($page_id); ?></h4><?php echo get_the_content( null, false, $page_id); ?>
                      </div>
                    </div>
                  </div>
                </div>
              </li>
              <div class="t-menu_underline"></div>
            </ul>
          </nav>
        </div>
        <div class="col s-header_r2c2"><a class="s-header_cart l-underline" href="/cart"><img class="s-header_cart-icon" src="<?php echo get_template_directory_uri(); ?>/img/icons/cart.svg"/>
            <div class="s-header_cart-count">Корзина <span><?php echo $goods_count = sprintf($woocommerce->cart->cart_contents_count); ?></span></div></a></div>
      </div>
    </div>
  </div>
  <div class="alert"></div>
</header>