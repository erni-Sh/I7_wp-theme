
<div class="row">
  <div class="col-12 products-list">
    <div class="row">
      <div class="col-lg-9 products-list_search-prnt">
        <div class="products-list_search">
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
      <div class="col-lg-3 products-list_total">
        
        <?php
        $countcat = $product_cat->count;
        $max_pages = ceil($countcat / 10); 
        ?>
        
        <p>Всего товаров: <span><?php echo $countcat; ?></span></p>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-12 text-center">
    
    <?php if($countcat) : ?>
    
    <button class="btn_white js-loader loader_new_cards is-hidden" data-page="1" data-category="<?php echo $product_cat->slug; ?>" data-container=".products-list" data-maxpage="<?php echo $max_pages ?>"><span>Показать еще</span></button>
    <div class="lds-facebook">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <?php endif ?>
    
  </div>
</div>