<?php
function webuilds_customize_register($wp_customize)
{
	$wp_customize->add_setting('webuild_link', [
		'default' => '#f72525',
		'transport' => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	]);
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'webuild_link', [
		'label' => __('Accent Color', 'theme_textdomain'),
		'section' => 'header_image',
		'settings' => 'webuild_link',
	]));

	// $wp_customize->add_section('custom_css', array(
	//     'title' => __('Custom CSS'),
	//     'description' => __('Add custom CSS here'),
	//     'panel' => '', // Not typically needed.
	//     'priority' => 160,
	//     'capability' => 'edit_theme_options',
	//     'theme_supports' => '', // Rarely needed.
	// ));
	$wp_customize->add_section('webuild_options', [
		'title' => 'Настройка верхнего меню',
		'panel' => '', // Not typically needed.
		'priority' => 10,
		'capability' => 'edit_theme_options',
		'theme_supports' => '', // Rarely needed.
		// 'priority' => 10,

	]);
	// Display description
	$wp_customize->add_setting('webuild_options', [
		'default' => true,
		'transport' => 'postMessage',
	]);

	$wp_customize->add_control('webuild_options', [
		'section' => 'webuild_options',
		'label' => 'Отображать описание',
		'type' => 'checkbox',
	]);

	// phone
	$wp_customize->add_setting('webuild_phone', [
		'default' => '',
		'transport' => 'refresh',
	]);

	$wp_customize->add_control('webuild_phone', [
		'section' => 'webuild_options',
		'label' => 'Телефон',
		'type' => 'text',
	]);
	// email
	$wp_customize->add_setting('webuild_email', [
		'default' => '',
		'transport' => 'refresh',
	]);

	$wp_customize->add_control('webuild_email', [
		'section' => 'webuild_options',
		'label' => 'Почта',
		'type' => 'url',
	]);
	// address
	$wp_customize->add_setting('webuild_address', [
		'default' => '',
		'transport' => 'refresh',
	]);

	$wp_customize->add_control('webuild_address', [
		'section' => 'webuild_options',
		'label' => 'Адрес',
		'type' => 'text',
	]);
}
add_action('customize_register', 'webuilds_customize_register');

function webuildt_customize_css()
{
?>
	<style type="text/css">
		html {
			color: <?php echo get_theme_mod('custom_css', '#f72525'); ?>;
		}
	</style>
<?php
}

add_action('wp_head', 'webuildt_customize_css');
// $wp_customize->add_control('custom_theme_css', array(
//     'label' => __('Custom Theme CSS'),
//     'type' => 'textarea',
//     'section' => 'custom_css',
// ));