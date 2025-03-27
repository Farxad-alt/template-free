<?php

/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WEBUILD
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area mt-6">
	<?php

	add_filter('comment_form_fields', 'theme_slug_new_comment_fields');
	if (!function_exists('theme_slug_new_comment_fields')) {
		function theme_slug_new_comment_fields($fields)
		{
			$new_fields = array();
			$new_order = array('author', 'email', 'url', 'comment'); // нужный порядок

			foreach ($new_order as $key) {
				$new_fields[$key] = $fields[$key];
				unset($fields[$key]);
			}
			if ($fields)
				foreach ($fields as $key => $val) {
					$new_fields[$key] = $val;
				}
			return $new_fields;
		}
	}

	$args = array(
		// изменяем текст кнопки отправки 
		'label_submit' => 'Submit',
		// удаляем сообщение со списком разрешенных HTML-тегов из-под формы комментирования
		'comment_notes_after' => '',
		'comment_notes_before' => '',
		//текст перед формой комментариев
		'title_reply' => __('Leave a comment'),
		//Меняем разметку полей author и email
		'fields' => array(
			'author' => '<div class="comment-author comment-block"><input id="author" name="author" type="text" value="" size="30" placeholder="Your name" /></div>',
			'email' => '<div class="comment-email comment-block"><input id="email" name="email" type="email" value="" size="30" placeholder="Your email" /></div>',
			'url' => '<div class="comment-url comment-block"><input id="url" name="url" type="url" value="" size="30" placeholder="Your url" /></div>'
		),
		//Меняем разметку поля комментария textarea
		'comment_field' => '<div class="comment-form-comment"><textarea id="comment" name="comment" 
        aria-required="true" placeholder="Your text"></textarea></div>',
		//Меняем разметку кнопки submit
		'submit_field' => '<div class="form-submit">%1$s %2$s</div>'
	);
	comment_form($args);
	?>

</div><!-- #comments -->