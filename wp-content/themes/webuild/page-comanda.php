<?php

get_header();
?>
<main id="primary" class="main">
	<!-- Page Header Start -->
	<div class="container-fluid page-header">
		<h1 class="display-3 text-uppercase text-white mb-3">Команда</h1>
		<div class="d-inline-flex text-white">
			<h6 class="text-uppercase m-0"><a href="/">Главная</a></h6>
			<h6 class="text-white m-0 px-3">/</h6>
			<h6 class="text-uppercase text-white m-0">Команда</h6>
		</div>
	</div>
	<!-- Page Header Start -->
	<?php get_template_part('template-parts/single', 'workers') ?>
	<div class="container-fluid pb-6 px-5">
		<div class="row g-5">
			<?php $reviews = new WP_Query([
				'post_type' => 'workers',
				'posts_per_page' => -1,
			]);
			if ($reviews->have_posts()) {
				while ($reviews->have_posts()) {
					$reviews->the_post(); ?>
					<div class="col-xl-3 col-lg-4 col-md-6">
						<div class="row g-0">
							<div class="col-10" style="min-height: 300px;">
								<?php echo wfmtest_post_thumb(get_the_ID(), 'full', 'position-relative h-100 workers-img') ?>
							</div>
							<div class="col-2">
								<div class="h-100 d-flex flex-column align-items-center justify-content-between bg-light">
									<?php if (get_field('tviter')): ?>
										<a class="btn" href="<?php the_field('tviter', $post_id); ?>"><i class="fab fa-twitter"></i></a>
									<?php endif; ?>
									<?php if (get_field('fejsbuk')): ?>
										<a class="btn" href="<?php the_field('fejsbuk'); ?>"><i class="fab fa-facebook-f"></i></a>
									<?php endif; ?>
									<?php if (get_field('linkedin')): ?>
										<a class="btn" href="<?php the_field('linkedin', $post_id); ?>"><i class="fab fa-linkedin-in"></i></a>
									<?php endif; ?>
									<?php if (get_field('instagram')): ?>
										<a class="btn" href="<?php the_field('instagram'); ?>"><i class="fab fa-instagram"></i></a>
									<?php endif; ?>
									<?php if (get_field('yutub')): ?>
										<a class="btn" href="<?php the_field('yutub'); ?>"><i class="fab fa-youtube"></i></a>
									<?php endif; ?>
								</div>
							</div>
							<div class="col-12">
								<div class="bg-light p-4">
									<h4 class="text-uppercase "><?php the_title(); ?></h4>
									<span><?php echo the_field('rabotnik'); ?></span>
								</div>
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
</main>
<?php get_footer(); ?>