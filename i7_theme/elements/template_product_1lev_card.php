
<div class="col-xl-4 col-lg-6">
  <?php $classScroll = 'js-scrollUp';
  if(is_front_page()) $classScroll = ''; ?><a class="<?php echo $classScroll; ?> product-1-lev" href="<?php echo "products#" . $card_data->slug; ?>">
    <h6 class="product-1-lev_title"><?php echo $card_data-> name; ?></h6>
    <div class="product-1-lev_descr text-small"><?php echo $card_data-> description; ?></div>
    <div class="product-1-lev_trumb">
      <?php 
      $thumbnail_id = get_woocommerce_term_meta( $card_data->term_id, 'thumbnail_id', true );
      if($thumbnail_id) :
      ?><img src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>"/><?php endif; ?>        
    </div></a>
</div>