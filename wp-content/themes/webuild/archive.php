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

                <div class="row">

                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                                        <?php get_template_part('template-parts/single', get_post_format()) ?>
                                <?php endwhile;
                        else: ?>
                                Записей нет.
                        <?php endif; ?>


                </div>
        </div>


</main><!-- #main -->

<?php

get_footer();
