<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="container-fluid ">
		<header class="entry-header pt-5 ">
			<?php the_title(sprintf('<h2 class="entry-title "><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>


		</header><!-- .entry-header -->

		<?php the_post_thumbnail(); ?>

		<div class="entry-summary">
			<?php the_content(); ?>
		</div><!-- .entry-summary -->


	</div>
</article><!-- #post-<?php the_ID(); ?> -->