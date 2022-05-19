
<div class="col-12"><a class="product-23-lev js-scrollUp" href="<?php echo "/products#" . $card_data->slug ?>">
    <div class="product-23-lev_trumb">
      <?php 
      $thumbnail_id = get_woocommerce_term_meta( $card_data->term_id, 'thumbnail_id', true );
      if($thumbnail_id) :
      ?><img src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>"/><?php else : ?><img src="<?php echo get_template_directory_uri(); ?>/img/icons/no_photo.svg"/><?php endif; ?>
    </div>
    <div class="product-23-lev_content">
      <h6 class="product-23-lev_title"><?php echo $card_data->name ?></h6>
      <div class="product-23-lev_descr text-small"><?php echo $card_data->description; ?></div>
    </div></a></div>