
<div class="col-12">
  <div class="solution-inside-card gray-card">
    <div class="solution-inside-card_trumb">
      <?php 
      $thumbnail_id = get_woocommerce_term_meta( $card_data->term_id, 'thumbnail_id', true );
      if($thumbnail_id) :
      ?><img src="<?php echo wp_get_attachment_url( $thumbnail_id ); ?>"/><?php endif; ?>
    </div>
    <div class="solution-inside-card_content"><a href="<?php echo "/products#" . $card_data->slug ?>">
        <h6 class="solution-inside-card_title"><?php echo $card_data->name; ?></h6></a>
      <div class="solution-inside-card_descr text-small"><?php echo $card_data->description; ?></div>
      <div class="solution-inside-card_list">
        <ul><?php showSolutionInsideCardList($solution_cat, $card_data->term_id); ?></ul>
      </div>
    </div>
  </div>
</div>