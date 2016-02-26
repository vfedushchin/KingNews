<div class="inner">
	<div class="content-wrapper">
		<header class="entry-header">
			<?php echo $image; ?>

				<div class="post__cats"><?php echo $terms_line; ?></div>

			<div class="carousel--inner">
				<div class="entry-content">
					<?php echo '<h5 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . king_news_get_short_title(75) . '</a></h5>'; ?>

					<?php echo $content; ?>
					<?php echo $more_button; ?>
				</div>

				<footer class="entry-footer">
					<div class="entry-meta">
						<span class="post__date">
							<?php
								king_news_meta_date( 'loop', array(
									'before' => '<i class="material-icons">access_time</i>',
								) );
							?>
						</span>
					</div>
				</footer>
			</div>

		</header>

	</div>

</div>