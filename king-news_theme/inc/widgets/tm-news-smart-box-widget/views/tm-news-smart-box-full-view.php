<div class="inner">
	<header class="entry-header">
		<?php echo $image; ?>
	</header>
	<div class="entry-content">
		<div class="post__cats"><?php echo $terms_line; ?></div>
		<?php echo $title; ?>
		<div class="entry-meta">
			<span class="post__date"><i class="material-icons">access_time</i><?php echo $date; ?></span>
			<div class="post__author vcard"><span><?php echo esc_html__( 'By ', 'king_news' ); ?></span><?php echo $author; ?></div>
			<span class="post__comments"><i class="material-icons">chat_bubble_outline</i><?php echo $comments; ?></span>
			<?php king_news_share_buttons( 'loop' ); ?>
		</div>
		<?php echo $content; ?>
	</div>
	<footer class="entry-footer"></footer>
</div>