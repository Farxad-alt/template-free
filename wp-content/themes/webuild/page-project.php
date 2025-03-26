<?php

get_header();
?>
<main id="primary" class="main">
	<!-- Page Header Start -->
	<div class="container-fluid page-header">
		<h1 class="display-3 text-uppercase text-white mb-3">Проекты</h1>
		<div class="d-inline-flex text-white ">
			<h6 class="text-uppercase m-0"><a href="/">Главная</a></h6>
			<h6 class="text-white m-0 px-3">/</h6>
			<h6 class="text-uppercase text-white m-0">Проекты</h6>
		</div>
	</div>
	<!-- Page Header Start -->

	<?php get_template_part('template-parts/content', 'project')
	?>

</main>
<?php get_footer(); ?>