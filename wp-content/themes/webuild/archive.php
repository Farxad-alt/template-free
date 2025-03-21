<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WEBUILD
 */

get_header();
?>

	<main id="primary" class="site-main">

		   <!-- Services Start -->
		   <div class="container-fluid bg-light py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 text-uppercase mb-4">We Provide <span class="text-primary">The Best</span> Construction Services</h1>
        </div>
        <?php get_template_part('template-parts/content', get_post_format())?>

</div>
        <!-- Services End -->

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
