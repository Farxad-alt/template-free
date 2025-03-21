<?php

/**
 * Plugin Name: Parallax-admin
 */

// defined('ABSPATH') || die();

add_action('login_header', 'pbps_add_template');
add_action('login_enqueue_scripts', 'pbps_enqueue_assets');

/**
 * Подключает шаблон.
 *
 * @return void
 */
function pbps_add_template()
{
	include __DIR__ . '/template.php';
}

/**
 * Подключает JS и CSS плагина.
 *
 * @return void
 */
function pbps_enqueue_assets()
{
	wp_enqueue_style('pbps-styles', plugins_url('assets/styles.css', __FILE__));
	wp_enqueue_script('pbps-scripts', plugins_url('assets/scripts.js', __FILE__)); { ?>
	
<?php }
}

// function editLoginPage()
// add_action('login_enqueue_scripts', 'editLoginPage');
function editLoginPageTitle()
{
	return 'Мой сайт';
}
add_action('login_headertext', 'editLoginPageTitle');
function editLoginPageTitleUrl()
{
	return 'http://template-free';
}
add_action('login_headerurl', 'editLoginPageTitleUrl');
