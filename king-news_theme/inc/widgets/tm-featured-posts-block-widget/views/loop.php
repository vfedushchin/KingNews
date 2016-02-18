<?php
/**
 * Template part to display a single post while in a layout posts loop
 *
 * @package    __tm/widgets
 */

?>
<div class="tm_fpblock__item tm_fpblock__item-<?php print $item_count; ?> post-<?php the_ID(); ?> tm_fpblock__item-<?php print esc_attr( $special_class ); ?>">

	<?php $preview_url = get_the_post_thumbnail_url( null, $image_size ); ?>
	<div class="tm_fpblock__item__preview" style="background-image: url('<?php print esc_attr( $preview_url ); ?>');">
		<img src="<?php print esc_attr( $preview_url ); ?>">
	</div>

	<?php if ( 'true' === $this->instance['checkboxes']['categories'] ) : ?>
		<?php print $this->post_categories(
			array(
				'before' => '<div class="tm_fpblock__item__categories">',
				'after'  => '</div>',
				'format' => '<a href="%1$s" class="tm_fpblock__item__category">%2$s</a>',
			)
		); ?>
	<?php endif; ?>

	<div class="tm_fpblock__item__description">

		<?php if ( 'true' === $this->instance['checkboxes']['title'] ) : ?>
			<?php the_title( sprintf( '<a class="tm_fpblock__item__title" href="%s">', esc_url( get_the_permalink() ) ), '</a>' ); ?>
		<?php endif; ?>

		<?php if ( 'true' === $this->instance['checkboxes']['date'] ) : ?>
			<?php print $this->post_date(
				array(
					'for_human' => true,
					'format'    => 'H:i:s',
					'before'    => '<span class="tm_fpblock__item__date"><i class="material-icons dp18">access_time</i>',
					'after'     => '</span>',
				)
			); ?>
		<?php endif; ?>

		<?php if ( 'true' === $this->instance['checkboxes']['comments_count'] ) : ?>
			<?php print $this->post_comments_count(
				array(
					'before'       => '<div class="tm_fpblock__item__comments_count">',
					'after'        => '</div>',
					'has_comments' => '<a href="%1$s">%2$s</a>',
					'no_comments'  => '<span>%2$s</span>',
				)
			); ?>
		<?php endif; ?>

		<?php if ( 'true' === $this->instance['checkboxes']['author'] ) : ?>
			<?php print $this->post_author(
				array(
					'before'  => '<div class="tm_fpblock__item__author">',
					'after'   => '</div>',
					'has_url' => '<a href="%1$s">%2$s</a>',
					'no_url'  => '%2$s',
				)
			); ?>
		<?php endif; ?>

		<?php if ( 'true' === $this->instance['checkboxes']['excerpt'] ) : ?>
			<div class="tm_fpblock__item__content">
				<?php wp_trim_words( the_excerpt(), $this->instance['excerpt_length'] || 55 ); ?>
			</div>
		<?php endif; ?>

		<?php if ( 'true' === $this->instance['checkboxes']['tags'] ) : ?>
			<?php print $this->post_tags(
				array(
					'before' => '<div class="tm_fpblock__item__tags">',
					'after'  => '</div>',
					'format' => '<a href="%1$s" class="tm_fpblock__item__tag">%2$s</a>',
				)
			); ?>
		<?php endif; ?>
	</div>
</div>
