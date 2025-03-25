<?php
/*
 * Добавляем метабокс
 */
add_action('add_meta_boxes', 'true_meta_boxes_u');

function true_meta_boxes_u()
{

	add_meta_box('truediv', 'Настройки', 'true_print_box_u', 'post', 'normal', 'side');
}

// }

// add_action('add_meta_boxes', 'wfmtest_add_metabox');
/*
  Заполняем метабокс
 */
// function true_print_box_u($post)
// {
// 	if (function_exists('true_image_uploader_field')) {
// 		true_image_uploader_field([
// 			'name' => 'uploader_custom',
// 			'value' => get_post_meta($post->ID, 'uploader_custom', true),
// 		]);
// 	}
// }

// /*
//  * Сохраняем данные произвольного поля
//  */
// add_action('save_post', 'true_save_box_data_u');
// function true_save_box_data_u($post_id)
// {

// 	// 	// ... тут различные проверки на права пользователя, на тип поста, на то, что не автосохранение и т д

// 	if (isset($_POST['uploader_custom'])) {
// 		update_post_meta($post_id, 'uploader_custom', absint($_POST['uploader_custom']));
// 	}
// 	return $post_id;
// }

/* Create one or more meta boxes to be displayed on the post editor screen. */
