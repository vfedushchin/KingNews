<div class="inner">
	<header class="entry-header">
		<?php echo $image; ?>
	</header>
	<div class="entry-content">
		<h5 class="widget-new-smart__title widget-new-smart__title-small">
			<?php echo $title; ?>
		</h5>
		<?php echo $content; ?>
		<div class="entry-meta">
			<div class="meta-inner">
				<span class="post__date">
					<?php 
						king_news_meta_date( 'loop', array(
							'before' => '<i class="material-icons">access_time</i>',
						) );
					 ?>
				</span>

				<?php
					king_news_meta_comments( 'loop', array(
						'before' => '<i class="material-icons">chat_bubble_outline</i>',
						'after' => '',
						'zero'   => esc_html__( 'Leave a comment', '__tm' ),
						'one'    => '1 comment',
						'plural' => '% comments',
					) );
				?>

			</div>

			<?php king_news_share_buttons( 'loop' ); ?>
		</div>
	</div>
	<footer class="entry-footer"></footer>
</div>