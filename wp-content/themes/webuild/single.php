<?php get_header()?>

<div class="row p-5">
        
        <?php  while ( have_posts() ) : the_post(); ?>
       <?php get_template_part('template-parts/single',get_post_format() )?>
        <?php endwhile; ?>
    </div>
<?php get_footer()?>
