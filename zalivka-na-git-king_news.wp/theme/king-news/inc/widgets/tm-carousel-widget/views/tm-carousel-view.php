<div class="inner">
	<div class="content-wrapper">
		<header class="entry-header">
			<?php echo $image; ?>
			<div class="post__cats"><?php echo $terms_line; ?></div>
		</header>
		<div class="entry-content">
			<div class="post__author vcard"><span><?php echo esc_html__( 'Posted by ', 'king_news' ); ?></span><?php echo $author; ?></div>
			<?php echo $title; ?>
			<?php echo $content; ?>
			<?php echo $more_button; ?>
		</div>
	</div>
	<footer class="entry-footer">
		<div class="entry-meta">
			<span class="post__date"><i class="material-icons">event</i><?php echo $date; ?></span>
			<span class="post__comments"><i class="material-icons">mode_comment</i><?php echo $comments; ?></span>
		</div>
	</footer>
</div>