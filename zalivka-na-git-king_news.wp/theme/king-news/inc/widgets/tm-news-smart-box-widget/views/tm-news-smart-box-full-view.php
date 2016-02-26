<div class="inner widget-new-smart-inner-big-before-content">
	<figure class="widget-new-smart-main">
		<?php echo $image; ?>

		<figcaption >
			<div class="post__cats"><?php echo $terms_line; ?></div>
			<div></div>


			<div class="widget-new-smart__footer">
				<h3 class="widget-new-smart__title">
					<?php echo $title ?>
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



<div class="inner widget-new-smart-inner-big-after-content">
	<div class="inner">
		<header class="entry-header">
			<?php echo $image; ?>
		</header>
		<div class="entry-content">
			<h3 class="widget-new-smart__title widget-new-smart__title-small">
				<?php echo $title; ?>
			</h3>


				<div class="entry-meta-sharing">
					<div class="entry-meta">
						<?php
							king_news_meta_author(
								'loop',
								array(
									'before' => esc_html__( 'by', 'king_news' ) . ' ',
								)
							);
						?>

						<?php
							king_news_meta_date( 'loop', array(
								'before' => '<i class="material-icons">access_time</i>',
							) );

							king_news_meta_comments( 'loop', array(
								'before' => '<i class="material-icons">chat_bubble_outline</i>',
								'after' => '',
								'zero'   => esc_html__( 'Leave a comment', '__tm' ),
								'one'    => '1 comment',
								'plural' => '% comments',
							) );

							king_news_meta_tags( 'loop', array(
								'before'    => '<i class="material-icons">folder_open</i>',
								'separator' => ', ',
							) );
						?>
					</div><!-- .entry-meta -->
				</div><!-- .entry-meta-sharing -->


			
			<p><?php king_news_blog_content(50); ?></p>

		</div>
			<footer class="entry-footer">
				<?php king_news_read_more(); ?>
				<?php king_news_share_buttons( 'loop' ); ?>
			</footer><!-- .entry-footer -->
	</div>
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