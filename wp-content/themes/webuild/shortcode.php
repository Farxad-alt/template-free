<?php

/**
 * Plugin Name: Shortcode Lesson 1
 * Plugin URI: https://github.com/campusboy87/lessons-shortcode
 * Author: Обучающий YouTube канал "WP-PLUS"
 * Author URI: https://www.youtube.com/c/wpplus
 */

add_shortcode('fa-home', 'show_home');
function show_home()
{

    return '<i class="fa fa-home fa-4x text-primary"></i>';
}

add_shortcode('fa-building', 'show_building');
function show_building()
{
    return '<i class="fa fa-3x fa-building text-primary"></i>';
}



// Узнать, что в переменных
// var_dump($atts, $content, $tag);

//  return 'Привет';

// Контентный шоткод
// return '<div style="color: #0A246A">' . $content . '</div>';
//}

// Вывод обычного шоткода
// echo do_shortcode('[box], дорогие зрители!');

// Вывод контентного шоткода
// echo do_shortcode('[box]Привет, уважаемые зрители![/box]');

// Вывод обычного шоткода без параметров
// echo show_box();

// Вывод шоткода на примере формы плагина Contact Form 7
// echo do_shortcode('[contact-form-7 id="138" title="Обратная связь"]');

// Вывод шоткода на примере формы плагина Contact Form 7 с помощью формы обработчика
// echo wpcf7_contact_form_tag_func(
//   [
//     'id'    => '138',
//     'title' => 'Contact form 1',
//   ],
//   '',
//   'contact-form-7'
// );




add_shortcode('box', 'show_box');
function show_box($atts, $content, $tag)
{
    return '<i style="color: #0A246">' . $content . '<i>';
}
add_filter('the_content', 'do_shortcode', 11);
