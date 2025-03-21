<?php if (is_page('grid')) : ?>
	<div class="container-fluid py-6 px-5">
		<div class="text-center mx-auto mb-5" style="max-width: 600px;">
			<h2 class="display-5 text-uppercase mb-4 section-title">
				<?= blogText(); ?>
			</h2>

		</div>
		<div class="row g-5">
			<?php
			global $post;

			$query = new WP_Query([
				'category_name' => 'poslednie-stati-iz-nashego-bloga',
				'orderby'        => 'ASC',
			]);
			?>
			<?php if ($query->have_posts()) : ?>
				<?php while ($query->have_posts()) :
					$query->the_post();
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
				<?php endwhile; ?>

				<?php wp_reset_postdata(); ?>

				<div class="col-12">
					<?php
					echo paginate_links([
						'base'    => user_trailingslashit(wp_normalize_path(get_permalink() . '/%#%/')),
						'current' => max(1, get_query_var('page')),
						'total'   => $query->max_num_pages,
					]);
					?>
				</div>



			<?php else : ?>
				<p><?php esc_html_e('Нет постов по вашим критериям.'); ?></p>
			<?php endif; ?>
		</div>
	</div>
<?php else : ?>
	<div class="container-fluid py-6 px-5">
		<div class="text-center mx-auto mb-5" style="max-width: 600px;">
			<h2 class="display-5 text-uppercase mb-4 section-title">
				<?= blogText(); ?>
			</h2>

		</div>
		<div class="row g-5">
			<?php
			global $post;

			$myposts = get_posts([
				'numberposts' => 3,
				'category_name'    => 'poslednie-stati-iz-nashego-bloga',

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
<?php endif; ?>