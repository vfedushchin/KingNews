<div class="inner widget-new-smart-inner-big-before-content">
	<figure class="widget-new-smart-main">
		<?php echo $image; ?>

		<figcaption >
			<div class="post__cats"><?php echo $terms_line; ?></div>


			<div class="widget-new-smart__footer">
				<h3 class="widget-new-smart__title">
					<?php echo wp_trim_words($title, 5); ?>
				</h3>

				<div class="widget-new-smart__footer-2">
					<span class="widget-new-smart__post__date">
						<?php
							king_news_meta_date( 'loop', array(
								'before' => '<i class="material-icons">access_time</i>',
							) );
						?>
					</span>
					<?php king_news_share_buttons( 'loop' ); ?>
				</div>
			</div>

		</figcaption>
	</figure>
</div>





<!-- 
<div class="inner">
	<header class="entry-header">
		<?php echo $image; ?>
	</header>
	<div class="entry-content">
		<div class="post__cats"><?php echo $terms_line; ?></div>
		<?php echo $title; ?>
		<div class="entry-meta">
			<span class="post__date"><i class="material-icons">event</i><?php echo $date; ?></span>
			<div class="post__author vcard"><span><?php echo esc_html__( 'by ', 'king_news' ); ?></span><?php echo $author; ?></div>
			<span class="post__comments"><i class="material-icons">mode_comment</i><?php echo $comments; ?></span>
		</div>
		<?php echo $content; ?>
	</div>
	<footer class="entry-footer"></footer>
</div> -->