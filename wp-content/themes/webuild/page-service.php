<?php get_header(); ?>

<!-- Page Header Start -->
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Услуги</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a href="/">Главная</a></h6>
        <h6 class="text-white m-0 px-3">/</h6>
        <h6 class="text-uppercase text-white m-0">Услуги</h6>
    </div>
</div>
<!-- Page Header Start -->
<!-- Services Start -->
<div class="container-fluid bg-light py-6 px-5 services">
    <div class="text-center mx-auto mb-5" style="max-width: 600px;">
        <h2 class="display-5 text-uppercase mb-4 section-title"> <?= servicesText(); ?>
        </h2>
    </div>
    <div class="row g-5">
        <?php // параметры по умолчанию
        $my_posts = get_posts(array(
            'numberposts' => 6,
            'category'    => 11,

            'post_type'   => 'post',
            'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
        ));

        global $post;

        foreach ($my_posts as $post) {
            setup_postdata($post);
        ?>

            <?php get_template_part('template-parts/content', get_post_format()) ?>

        <?php     }

        wp_reset_postdata(); // сброс
        ?>

    </div>
</div>
<!-- Services End -->


<!-- Appointment Start -->
<?php
global $post;

$myposts = get_posts([
    'numberposts' => -1,
    'category_name'    => 'call-back',

]);
?>

<div class="container-fluid py-6 px-5 ">
    <div class="row gx-5">
        <?php
        if ($myposts) {
            foreach ($myposts as $post) {
                setup_postdata($post);
        ?>
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h2 class="display-6 section-title"><?= reviewsText() ?></h2>

                        <?php the_content(); ?>
                    </div>
                </div>
        <?php
            }
        } else {
            echo 'постов нет';
        }

        wp_reset_postdata(); // Сбрасываем $post
        ?>

        <div class="col-lg-8 bg-light">
            <div class=" text-center p-5">

                <?php echo do_shortcode('[contact-form-7 id="45cbafe" title="Без названия"]'); ?>

            </div>
        </div>

    </div>
</div>

<!-- Appointment End -->

<!-- Testimonial Start -->
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
<!-- Testimonial End -->
<?php get_footer(); ?>