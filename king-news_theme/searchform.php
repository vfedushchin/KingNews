<?php
/**
 * The template for displaying search form.
 *
 * @package king_news
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<label>
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'king_news' ) ?></span>
		<input type="search" class="search-form__field"
			placeholder='<?php echo esc_attr_x( "I'm looking for....", "placeholder", "king_news" ) ?>'
			value="<?php echo get_search_query() ?>" name="s"
			title="<?php echo esc_attr_x( 'Search for:', 'label', 'king_news' ) ?>" />
	</label>
	<button type="submit" class="search-form__submit btn"><span class="search-btn-txt"><?php esc_html_e( 'Search', 'king_news' ); ?></span><i class="material-icons">search</i></button>
</form>