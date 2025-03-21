<?php get_header() ?>
<!-- Page Header Start -->
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Сетка блога</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a href="">Главная</a></h6>
        <h6 class="text-white m-0 px-3">/</h6>
        <h6 class="text-uppercase text-white m-0">Сетка блога</h6>
    </div>
</div>
<!-- Page Header Start -->


<!-- Blog Start -->
<section class="blog">
    <?php get_template_part('template-parts/content', 'grid') ?>
</section>
<!-- Blog End -->
<?php get_footer() ?>