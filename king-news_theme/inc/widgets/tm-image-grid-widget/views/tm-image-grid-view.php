<div class="widget-image-grid__holder invert col-xs-12 col-sm-6 col-md-<?php echo $columns_class; ?> col-lg-<?php echo $columns_class; ?>">
	<figure class="widget-image-grid__inner" <?php echo $inline_style; ?>>
		<?php echo $image; ?>
		<figcaption class="widget-image-grid__content">

      <?php king_news_meta_categories( 'both-loop-single' ); ?>

			<div class="widget-image-grid__content-2">
        <h3 class="widget-image-grid__title">
          <a href="<?php echo $permalink; ?>"><?php echo $title ?></a>
        </h3>
  
        <div class="widget-image-grid__footer">
          <div class="widget-image-grid__footer-meta">
            <?php king_news_meta_author('both-loop-single', array('before' => esc_html__( 'by', 'king_news' ) . ' ',));?>
            <a class="widget-image-grid__link" href="<?php echo $permalink; ?>"><i class="material-icons dp18">access_time</i><?php echo $date; ?></a>
          </div>
          <?php king_news_share_buttons( 'both-loop-single' ); ?>
        </div>
      </div>


    </figcaption>
  </figure>
</div>