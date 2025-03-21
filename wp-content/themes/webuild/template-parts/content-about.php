 <!-- About Start -->
 <div class="container-fluid py-md-4 py-6 px-5 ">
 	<div class="row g-5">
 		<div class="col-lg-7">

 			<?php if (have_posts()) : query_posts(array('posts_per_page' => 1, 'cat' => 10)); ?>
 				<?php while (have_posts()) : the_post(); ?>
 					<h2 class="section-title display-5"><?= reviewsText() ?></h2>
 					<?php the_content(); ?>

 					<img src="<?= get_template_directory_uri() ?>/img/signature.jpg" alt="">
 		</div>
 		<div class="col-lg-5 pb-5" style="min-height: 400px;">
 			<div class="position-relative bg-dark-radial leader__content">
 				<!-- <div class="col-lg-5 pb-5" style="min-height: 500px;"> -->
 				<div class="position-relative leader__content-img  ms-md-5">
 					<?php echo the_post_thumbnail('full', ['class' => 'position-lg-absolute w-100 mt-5 ms-n5 leader-img']); ?>

 				</div>
 			</div>
 		</div>
 	<?php endwhile; ?>
 <?php endif;
				wp_reset_query(); ?>


 	</div>
 </div>
 <!-- About End -->