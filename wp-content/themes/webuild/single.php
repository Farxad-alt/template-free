<?php get_header() ?>
<main id="main" class="main">
    <div class="row p-5">

        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('template-parts/single', get_post_format()) ?>
        <?php endwhile; ?>
    </div>
</main>
<?php get_footer() ?>