<?php

get_header();
?><?php
	if (is_category('grid')) : ?>
<main id="primary" class="main">
	<div class="container-fluid py-6 px-5">
		<div class="text-center mx-auto mb-5" style="max-width: 600px;">
			<h2 class="display-5 text-uppercase mb-4 section-title">
				<?= cat_description(); ?>
			</h2>

		</div>
		<div class="row g-5">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<div class="col-lg-4 col-md-6">
						<div class="bg-light">
							<?php echo wfmtest_post_thumb(get_the_ID(), 'large', 'blog-img') ?>
							<div class="p-4">
								<div class="d-flex justify-content-between mb-4">
									<div class="d-flex align-items-center">
										<?php the_content(); ?>
									</div>
									<div class="d-flex align-items-center">
										<span class="ms-3"><i class="far fa-calendar-alt text-primary me-2"></i><?php echo get_the_date('d M, Y'); ?></span>
									</div>
								</div>
								<h4 class="text-uppercase mb-3"><?php the_title() ?></h4>
								<a class="btn text-primary" href="<?php the_permalink(); ?>">Читать далее <i class="bi bi-arrow-right"></i></a>

							</div>
						</div>
					</div>
				<?php endwhile; ?>
				<div class="col-12">
					<?php
					echo paginate_links(
						[
							'show_all'     => true,
							'prev_next'    => true,
							'prev_text' 	 => '«',
							'next_text'    => '»',
							'type'         => 'plain',
							'add_args'     => False,
							'type' => 'list',
						]
					);
					?>

				</div>
			<?php
			else: ?>
				Записей нет.
			<?php endif; ?>
		</div>
	</div>

<?php else : (is_front_page()) ?>
	<div class="container-fluid py-6 px-5">
		<div class="text-center mx-auto mb-5" style="max-width: 600px;">
			<h2 class="display-5 text-uppercase mb-4 section-title">
				<?= cat_description(); ?>
			</h2>

		</div>
		<div class="row g-5">
			<?php
			global $post;

			$myposts = get_posts([
				'numberposts' => 3,
				'category_name'    => 'grid',

			]);

			if ($myposts) {
				foreach ($myposts as $post) {
					setup_postdata($post);

			?>
					<div class="col-lg-4 col-md-6">
						<div class="bg-light">
							<?php echo wfmtest_post_thumb(get_the_ID(), 'large', 'blog-img') ?>
							<div class="p-4">
								<div class="d-flex justify-content-between mb-4">
									<div class="d-flex align-items-center">
										<?php the_content(); ?>
									</div>
									<div class="d-flex align-items-center">
										<span class="ms-3"><i class="far fa-calendar-alt text-primary me-2"></i><?php echo get_the_date('d M, Y'); ?></span>
									</div>
								</div>
								<h4 class="text-uppercase mb-3"><?php the_title() ?></h4>
								<a class="btn text-primary" href="<?php the_permalink(); ?>">Читать далее <i class="bi bi-arrow-right"></i></a>

							</div>
						</div>
					</div>




				<?php
				} ?>

			<?php
			} else {
				echo 'Записей нет';
			}

			wp_reset_postdata();
			?>
		</div>
	</div>

<?php endif;
?>

</main><!-- #main -->
<?php

get_footer();
