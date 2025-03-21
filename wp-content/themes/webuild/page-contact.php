<?php get_header(); ?>
<!-- Page Header Start -->
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Контакты</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a href="/">Главная</a></h6>
        <h6 class="text-white m-0 px-3">/</h6>
        <h6 class="text-uppercase text-white m-0">Контакты</h6>
    </div>
</div>
<!-- Page Header Start -->

<!-- Contact Start -->
<div class="container-fluid py-6 px-5">
    <div class="text-center mx-auto mb-5" style="max-width: 600px;">

        <h2 class="display-5 text-uppercase mb-4 section-title"><?php echo contaсtText(); ?></h2>
    </div>
    <div class="row gx-0 align-items-center">
        <div class="col-lg-6 mb-5 mb-lg-0" style="height: 600px;">
            <?php the_content(); ?>

        </div>
        <div class="col-lg-6 z-2 position-relative">
            <div class="contact-form bg-light ">
                <!-- <div class="col-lg-8 bg-light"> -->
                <div class=" text-center p-5 ">

                    <?php echo do_shortcode('[contact-form-7 id="45cbafe" title="Без названия"]'); ?>

                </div>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->
<?php get_footer(); ?>