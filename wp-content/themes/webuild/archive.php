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

<main id="primary" class="main">


        <div class="container-fluid py-6 px-5">
                <div class="text-center mx-auto mb-5" style="max-width: 600px;">
                        <h2 class="display-5 text-uppercase mb-4 section-title">
                                <?php the_archive_description(); ?>
                        </h2>

                </div>

                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                                <?php get_template_part('template-parts/content', get_post_format()) ?>
                        <?php endwhile;
                else: ?>
                        Записей нет.
                <?php endif; ?>

        </div>


</main><!-- #main -->

<?php

get_footer();
