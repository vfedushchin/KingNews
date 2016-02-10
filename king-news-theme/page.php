    <?php

      ## Прикрепим функцию к фильтру 'my_filter_name'
add_filter('my_filter_name', 'my_filter_function2');
function my_filter_function2( $text22 ){
  // обрежем текст
  $text22 = mb_substr( $text22, 0, 30 ) .'...';

  return $text22;
}

## Обрабатывает текст. Функция, где применяется фильтр 'my_filter_name'
function text( $text ){
  // обрабатываем переданный текст - удалим html теги
  $text = strip_tags( $text );

  // теперь, возвращаем текст через фильтр.
  // Если к фильтру не прикреплена ни одна функция, то текст просто 
  // вернется как есть, т.е. строка ниже будет эквивалентна "return $text;"
  return apply_filters('my_filter_name', $text );
}

// Теперь, при вызове функция text() удалит из текста html теги (это сделает она сама) (функция strip_tags())
// и обрежет текст (это сделает фильтр) (функция my_filter_function())
$text = 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.';
echo text( $text );
// выведет: Lorem Ipsum is simply dummy te...

     ?>




<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package __tm
 */

while ( have_posts() ) : the_post();


	get_template_part( 'template-parts/content', 'page' );

	// If comments are open or we have at least one comment, load up the comment template.
	if ( comments_open() || get_comments_number() ) :
		comments_template();
	endif;

endwhile; // End of the loop. ?>