
<div class="col-12">
  <form class="product-card" action="" method="post" enctype="multipart/form-data">
    <div class="product-card_trumb">
      <?php $img_src = get_the_post_thumbnail_url();
      if ($img_src) : ?><img src="<?php echo $img_src ?>"/><?php else : ?><img src="<?php echo get_template_directory_uri();?>/img/icons/no_photo.svg"/><?php endif; ?>
    </div>
    <div class="product-card_content">
      <h3 class="product-card_title"><?php the_title() ?></h3>
      <div class="row">
        <div class="col-xl-7 product-card_descr">
          <div class="product-card_descr-wrap">
            <div class="product-card_catalog">
              <?php 
              $product_id = get_the_ID();
              $product_cats = get_the_terms( $product_id, 'product_cat' );
              $brands = array();
               
              foreach ($product_cats as $product_cat ):
              if($product_cat -> parent == 22) {
              array_push($brands, array(
              	'name' => $product_cat->name,
              	'slug' => $product_cat->slug
              ));
              }
              endforeach;
              ?>
              <p><b>Бренд:</b><?php
                if($brands) :
                foreach($brands as $brand) : ?><a href="<?php echo "/brands#" . $brand["slug"]; ?>"><?php echo strtoupper($brand["name"]); ?></a><?php if(next($brands)) echo ', ';
                endforeach;
                else:
                	 echo 'не указан';
                endif;
                ?>
              </p>
              <p><b>Артикул:</b><?php echo get_post_meta( $product_id, '_sku', true) ?></p><?php if(get_field('series')) : ?>
              <p><b>Серия:</b><?php echo get_field('series'); ?></p><?php endif; ?>
            </div>
            <div class="product-card_value">
              <ul>
                
                <?php
                $descr = get_post($product_id)->post_content;
                if($descr) :
                $descr = preg_split('/\r\n|\r|\n/', $descr);
                foreach($descr as $descr_item) :
                if($descr_item) :
                ?>
                <li><?php echo $descr_item ?></li><?php endif;
                endforeach;
                endif; ?>
              </ul>
            </div>
            <div class="product-card_prop">
              <table>
                
                <?php
                $descr = get_post($product_id)->post_excerpt;
                if($descr) :
                $descr = preg_split('/\r\n|\r|\n/', $descr);
                foreach($descr as $descr_item) :
                if($descr_item) :
                $descr_item = explode(":", $descr_item)
                ?>
                <tr>
                  <td> <b><?php echo $descr_item[0]; ?>:</b></td>
                  <td><?php echo $descr_item[1]; ?></td>
                </tr><?php endif;
                endforeach;
                endif; ?>
              </table>
            </div>
          </div>
          <div class="product-card_docs">
            
            <?php $tech_link = get_field("tech-link");
            if(substr($tech_link, -1) != '/') : ?>
             <img class="product-card_docs-icon" src="<?php echo get_template_directory_uri(); ?>/img/icons/pdf-icon.svg"/><a href="<?php echo get_site_url() . "/wc-products-import/" . basename($tech_link); ?>" target="_blank">Техническое описание продукта</a>
            <?php endif; ?>
            
          </div>
        </div>
        <div class="col-xl-5 product-card_count">
          
          <?php
          $price = str_replace(",", " ", number_format(get_post_meta( $product_id, '_price', true))); 
          	if($price) {
          	$price .= " " . get_field('currency') . " " . get_field('vat');
          	} else {
          		$price = 'Стоимость по запросу';
          	};
          ?>
          <div class="product-card_price"><?php echo $price ?></div>
          <div class="product-card_quantity">
            <p>Количество:</p>
            <input type="text" value="1" name="quantity" data-min-count="1"/>
          </div>
          <button class="product-card_btn single_add_to_cart_button" type="submit" name="add-to-cart" value="<?php echo esc_attr( get_the_ID() ); ?>">Добавить в Корзину</button>
        </div>
      </div>
    </div>
  </form>
</div>