<!-- Клиенты Start -->
<div class="container-fluid bg-light py-6 px-5">
	<?php $reviews = new WP_Query([
		'category_name' => 'slajder-klienty',
		'posts_per_page' => -1,
	]); ?>
	<div class="text-center mx-auto mb-5" style="max-width: 600px;">
		<h2 class="display-5 text-uppercase mb-4 section-title"><?php echo klientyText() ?></h2>
	</div>
	<div class="row gx-0 align-items-center">
		<div class="col-xl-4 col-lg-5 d-none d-lg-block">
			<?php echo get_the_post_thumbnail(670, 'full', array('class' => 'img-fluid w-100 h-100 mb-4 mb-md-0')); ?>

		</div>
		<div class="col-xl-8 col-lg-7 col-md-12">
			<div class="testimonial bg-light">
				<div class="owl-carousel testimonial-carousel">

					<?php $klienty = new WP_Query([
						'post_type' => 'klienty',
						'posts_per_page' => -1,
					]);
					if ($klienty->have_posts()) {
						while ($klienty->have_posts()) {
							$klienty->the_post(); ?>
							<div class="row gx-4 align-items-center">
								<?php echo wfmtest_post_thumb(get_the_ID(), 'full', 'col-xl-4 col-lg-5 col-md-5 klienty-img') ?>
								<div class="col-xl-8 col-lg-7 col-md-7">
									<h4 class="text-uppercase mb-0"><?php the_title(); ?></h4>
									<?php the_content(); ?>

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
		</div>
	</div>

</div>
<!-- Клиенты End -->