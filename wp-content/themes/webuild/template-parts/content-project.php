<?php global $post_id; ?>
<div class="container-fluid bg-light py-6 px-5">

	<?php
	global $post;

	$myposts = get_posts([
		'numberposts' => -1,
		'category_name'    => 'populyarnye-proekty',

	]);

	if ($myposts) {
		foreach ($myposts as $post) {
			setup_postdata($post);
	?>
			<div class="text-center mx-auto mb-5" style="max-width:600px">
				<h2 class="display-5 text-uppercase mb-4 section-title"><?= reviewsText() ?></h2>
			</div>
			<div class=" row gx-5">
				<div class="col-12 text-center">
					<div class="d-inline-block bg-dark-radial text-center pt-4 px-5 mb-5">
						<ul class="list-inline mb-0" id="portfolio-flters">
							<li class="btn btn-outline-primary bg-white p-2 active mx-2 mb-4 " data-filter="*">
								<?php $image = get_field('taby_verh_izobrazhenie1', $post_id); ?>
								<img src="<?php echo $image['sizes']['medium']; ?>" alt="" style="width: 150px; height: 100px;">
								<div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center" style="background: rgba(4, 15, 40, .3);">
									<h6 class="text-white text-uppercase m-0"> <?php echo the_field('zagolovok_taba_1', $post_id); ?></h6>
								</div>
							</li>
							<li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4" data-filter=".first">
								<?php $image = get_field('taby_verh_izobrazhenie2', $post_id); ?>
								<img src="<?php echo $image['sizes']['medium']; ?>" alt="" style="width: 150px; height: 100px;">
								<div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center" style="background: rgba(4, 15, 40, .3);">
									<h6 class="text-white text-uppercase m-0"> <?php echo the_field('zagolovok_taba_2', $post_id); ?></h6>
								</div>
							</li>
							<li class="btn btn-outline-primary bg-white p-2 mx-2 mb-4" data-filter=".second">
								<?php $image = get_field('taby_verh_izobrazhenie3', $post_id); ?>
								<img src="<?php echo $image['sizes']['medium']; ?>" alt="" style="width: 150px; height: 100px;">
								<div class="position-absolute top-0 start-0 end-0 bottom-0 m-2 d-flex align-items-center justify-content-center" style="background: rgba(4, 15, 40, .3);">
									<h6 class="text-white text-uppercase m-0"> <?php echo the_field('zagolovok_taba_3', $post_id); ?></h6>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
	<?php
		}
	} else {
		echo 'постов нет';
	}

	wp_reset_postdata(); // Сбрасываем $post

	?>

	<div class="row g-5 portfolio-container ">
		<?php if (have_posts()) : query_posts(['posts_per_page' => -1, 'order' => 'ASC', 'cat' => 26]); ?>
			<?php while (have_posts()) : the_post(); ?>
				<div class="col-xl-4 col-lg-6 col-md-6 portfolio-item ">
					<div class="position-relative portfolio-box">
						<?php echo the_post_thumbnail('full', array('class' => 'img-fluid w-100 h-100 mb-4 mb-md-0')); ?>
						<a class="portfolio-title shadow-sm" href="<?php the_permalink() ?>">
							<p class="h4 text-uppercase"><?php the_title(); ?></p>
							<span class="text-body d-flex align-items-center"><i class="fa fa-map-marker-alt text-primary me-2"></i>
								<?php echo the_excerpt(); ?>
							</span>
						</a>
						<a class="portfolio-btn" href="<?php echo $image['sizes']['large']; ?>" data-lightbox="portfolio">
							<i class="bi bi-plus text-white"></i>
						</a>
					</div>
				</div>
			<?php endwhile; ?>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		<?php

		$myposts = get_posts([
			'numberposts' => -1,

			'category'    => 40
		]);

		if ($myposts) {
			foreach ($myposts as $post) {
				setup_postdata($post);
		?>
				<div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
					<div class="position-relative portfolio-box">

						<?php echo the_post_thumbnail('full', ['class' => 'img-fluid w-100 h-100 mb-4 mb-md-0']); ?>
						<a class="portfolio-title shadow-sm" href="<?php the_permalink() ?>">
							<p class="h4 text-uppercase"><?php the_title(); ?></p>
							<span class="text-body d-flex align-items-center"><i class="fa fa-map-marker-alt text-primary me-2"></i>
								<?php echo the_excerpt(); ?>
							</span>
						</a>
						<a class="portfolio-btn" href="<?php echo $image['sizes']['large']; ?>" data-lightbox="portfolio">
							<i class="bi bi-plus text-white"></i>
						</a>
					</div>
				</div>
		<?php
			}
		} else {
			// Постов не найдено
		}

		wp_reset_postdata(); // Сбрасываем $post
		?>
		<?php

		$myposts = get_posts([
			'numberposts' => -1,

			'category'    => 39
		]);

		if ($myposts) {
			foreach ($myposts as $post) {
				setup_postdata($post);
		?>
				<div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
					<div class="position-relative portfolio-box">

						<?php echo the_post_thumbnail('full', array('class' => 'img-fluid w-100 h-100 mb-4 mb-md-0')); ?>
						<a class="portfolio-title shadow-sm" href="<?php the_permalink() ?>">
							<p class="h4 text-uppercase"><?php the_title(); ?></p>
							<span class="text-body d-flex align-items-center"><i class="fa fa-map-marker-alt text-primary me-2"></i>
								<?php echo the_excerpt(); ?>
							</span>
						</a>
						<a class="portfolio-btn" href="<?php echo $image['sizes']['large']; ?>" data-lightbox="portfolio">
							<i class="bi bi-plus text-white"></i>
						</a>
					</div>
				</div>
		<?php
			}
		} else {
			// Постов не найдено
		}

		wp_reset_postdata(); // Сбрасываем $post
		?>
	</div>

</div>