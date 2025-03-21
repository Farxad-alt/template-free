<?php

function webuild_add_admin_page()
{
	$hook_suffix = add_menu_page('WEB Theme Options', 'Мой метабокс', 'manage_options', 'webuild-options', 'webuild_create_page', get_template_directory_uri() . '/img/gerb.png', 150.2);

	add_submenu_page('webuild-options', 'WEB Theme Options', 'Общие', 'manage_options', 'webuild-options', 'webuild_create_page');

	add_submenu_page('webuild-options', 'WEB Theme Options Subpage', 'Дополнительные', 'manage_options', 'webuild-options-subpage', 'webuild_create_subpage');

	add_action("admin_print_scripts-{$hook_suffix}", "webuild_admin_scripts");
	add_action('admin_init', 'webuild_custom_settings');
	//	add_action( 'admin_enqueue_scripts', 'webuild_admin_scripts' );
}

add_action('admin_menu', 'webuild_add_admin_page');


function webuild_custom_settings()
{
	register_setting('webuild_general_group', 'webuild_email');
	register_setting('webuild_general_group', 'webuild_facebook');

	add_settings_section('webuild_general_section', 'Секция опций', function () {
		echo '<p>Текст, описывающий блок настроек</p>';
	}, 'webuild-options');

	add_settings_field('webuild_email_field', 'E-mail', 'webuild_general_email_field', 'webuild-options', 'webuild_general_section', array('label_for' => 'webuild_email_field'));

	add_settings_field('webuild_facebook_field', 'Facebook', 'webuild_general_facebook_field', 'webuild-options', 'webuild_general_section', array('label_for' => 'webuild_facebook_field'));
}

function webuild_general_email_field()
{
	$webuild_email = esc_attr(get_option('webuild_email'));

	echo "<input type=\"email\" name=\"webuild_email\" class=\"regular-text\" id=\"webuild_email_field\" value=\"$webuild_email\"> <p class=\"description\">Введите свой E-mail</p>";
}

function webuild_general_facebook_field()
{
	$webuild_facebook = esc_attr(get_option('webuild_facebook'));

	echo '<input type="text" name="webuild_facebook" class="regular-text" id="webuild_facebook_field" value="' . $webuild_facebook . '">';
}

function webuild_create_page()
{
	require get_template_directory() . '/inc/templates/webuild-options.php';
}

function webuild_create_subpage()
{
	require get_template_directory() . '/inc/templates/webuild-options-subpage.php';
}
function webuild_admin_scripts()
{
	wp_enqueue_style('webuild-admin-main-style', get_template_directory_uri() . '/css/admin-main.css');
}
