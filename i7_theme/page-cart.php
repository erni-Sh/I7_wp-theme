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
            <div class="col-12 cart">
              <form class="cart-list" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
                 
                <?php global $woocommerce;
                $items = $woocommerce->cart->get_cart();
                if($items) : ?>
                <div class="cart-list_header">
                  <div class="cart-list_col-article">Артикул</div>
                  <div class="cart-list_col-name">Наименование </div>
                  <div class="cart-list_col-count">Количество</div>
                  <div class="cart-list_col-price">Цена</div>
                  <div class="cart-list_col-cancel"></div>
                </div>
                <?php foreach($items as $cart_item_key => $cart_item) :
                $product_id = $cart_item['data']->get_id();
                $_product =  wc_get_product($product_id); ?>
                
                <div class="cart-list_product">
                  <div class="cart-list_col-article"><?php echo get_post_meta( $product_id, '_sku', true) ?></div>
                  <div class="cart-list_col-name"><?php echo $_product->get_title() ?></div>
                  <div class="cart-list_col-count">
                    <input type="number" id="<?php echo uniqid( 'quantity_' ) ?>" value="<?php echo $cart_item['quantity'] ?>" name="cart[<?php echo $cart_item["key"] ?>][qty]"/>
                  </div>
                  <div class="cart-list_col-price">
                    <?php $price = str_replace(",", " ", number_format(get_post_meta($product_id , '_price', true)));
                    	if($price) {
                    	$price .= " " . get_field('currency', $product_id);
                    	} else {
                    		$price = 'по запросу';
                    	};
                    echo $price; ?>
                  </div>
                  <div class="cart-list_col-cancel"><a href="<?php echo wc_get_cart_remove_url( $cart_item_key ) ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/cancel.svg"/></a></div>
                </div>
                <?php endforeach; ?>
                <div class="cart-update">
                  <button class="btn" type="submit" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>">Обновить корзину</button>
                </div><?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
                <?php else : ?>
                <?php
                echo '<script type="text/javascript">window.location = "/products"</script>'
                 ?>
                <?php endif; ?>
              </form>
              <div class="cart-form">
                <form class="checkout woocommerce-checkout form" name="checkout" method="post" action="/checkout" enctype="multipart/form-data">
                  <div class="pos-rel">
                    <input class="form__inputs name" name="billing_name" placeholder="" required="required"/>
                    <label class="form__label">Ваше имя</label>
                    <div class="error">Напишите свое имя</div>
                  </div>
                  <div class="pos-rel">
                    <input class="form__inputs e-mail" name="billing_email" placeholder="" required="required"/>
                    <label class="form__label">Ваш email</label>
                    <div class="error">Напишите ваш email</div>
                  </div>
                  <div class="pos-rel">
                    <input class="form__inputs phone" name="billing_phone" placeholder="" required="required"/>
                    <label class="form__label">Ваш телефон</label>
                    <div class="error">Напишите ваш телефон</div>
                  </div>
                  <div class="pos-rel">
                    <input class="form__inputs company" name="billing_company" placeholder="" required="required"/>
                    <label class="form__label">Название компании</label>
                    <div class="error">Напишите название компании</div>
                  </div>
                  <div class="pos-rel">
                    <textarea class="textarea form__inputs name" name="billing_message" placeholder="" required="required"></textarea>
                    <label class="form__label">Комментарии к заказу</label>
                  </div>
                  <div class="form__agree">
                    <input class="agree form__checkbox" type="checkbox"/>
                    <label for="argee">соглашаюсь с условиями <a class="l-underline" href="/docs" target="_blank">Политики конфиденциальности </a></label>
                    <div class="error">Подтвердите свое согласие</div>
                  </div>
                  <div class="form__btn">
                    <input type="hidden" name="payment_method" value="cheque" checked="checked"/>
                    <button class="js-order-submit" type="submit" name="woocommerce_checkout_place_order" data-user="<?php echo get_current_user_id(); ?>"><b>Оформить Заказ</b></button><?php wp_nonce_field( 'woocommerce-process_checkout', 'woocommerce-process-checkout-nonce' ); ?>
                  </div>
                </form>
                <div class="form_send-success"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/send-ok.png"/>
                  <div class="title">Cпасибо за Ваш заказ!</div>
                  <div class="title second-line"></div>
                  <div class="descr">Мы свяжемся с Вами в ближайшее время.</div>
                  <button class="btn js-finish-order">Хорошо</button>
                </div>
                <div class="form_send-error"><img src="<?php echo get_template_directory_uri(); ?>/img/icons/send-ok.png"/>
                  <div class="title">Ваш заказ не оформлен!</div>
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