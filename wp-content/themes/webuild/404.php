<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WEBUILD
 */

get_header();
?>

<main id="primary" class="main">

	<section class="error-404 not-found">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e('Такой страницы не существует.', 'webuild'); ?></h1>
		</header><!-- .page-header -->


	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
