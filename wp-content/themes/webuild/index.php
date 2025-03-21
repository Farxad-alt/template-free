<?php global $post_id;
get_header();
function debag($data)
{
    echo "<pre>" . print_r($data, 1) . "</pre>";
}

?>


<!-- Carousel Start -->
<main id="primary" class="main">

    <section class="reviews position-relative">
        <div class=" swiper-container reviews-slider">
            <div class=" slider_wrapper ">
                <div class="swiper reviews-swiper">
                    <div class="swiper-wrapper">
                        <?php $reviews = new WP_Query([
                            'post_type' => 'slider',
                            'posts_per_page' => -1,
                        ]);
                        if ($reviews->have_posts()) {
                            while ($reviews->have_posts()) {
                                $reviews->the_post(); ?>

                                <div class="swiper-slide reviews-slide">
                                    <?php $reviews_text = get_the_title();
                                    if ($reviews_text) : ?>
                                        <h1 class="reviews_text text-uppercase text-white "><?= $reviews_text; ?></h1>
                                    <?php endif; ?>
                                    <?php the_content(); ?>
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
                    <div class="swiper-button-next display-none">
                    </div>
                    <div class="swiper-button-prev">
                    </div>
                    <a href="#popup" class="btn btn-primary py-md-3 px-md-5 mt-2 slider-btn">Связаться с нами</a>


                </div>

            </div>
        </div>

    </section>

    <!-- Carousel End -->


    <!-- About Start -->
    <?php get_template_part('template-parts/content', 'about') ?>
    <!-- About End -->


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
    <?php get_template_part('template-parts/single', 'obratnyj-zvonok') ?>


    <!-- Appointment End -->


    <!-- Portfolio Start -->
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


                <div class="row g-5 portfolio-container ">
                    <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
                        <div class="position-relative portfolio-box">
                            <?php $image = get_field('tab_nizhnie_izobrazhenie_1', $post_id); ?>
                            <img class="img-fluid w-100" src="<?php echo $image['sizes']['large']; ?>" alt="">
                            <a class="portfolio-title shadow-sm" href="">
                                <p class="h4 text-uppercase"><?php echo the_field('zagolovok_nizhnego_izobrazhenie_1', $post_id); ?></p>
                                <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                            </a>
                            <a class="portfolio-btn" href="<?php echo $image['sizes']['large']; ?>" data-lightbox="portfolio">
                                <i class="bi bi-plus text-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
                        <div class="position-relative portfolio-box">
                            <?php $image = get_field('tab_nizhnie_izobrazhenie_2', $post_id); ?>
                            <img class="img-fluid w-100" src="<?php echo $image['sizes']['large']; ?>" alt="">
                            <a class="portfolio-title shadow-sm" href="">
                                <p class="h4 text-uppercase"><?php echo the_field('zagolovok_nizhnego_izobrazhenie_2', $post_id); ?></p>
                                <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                            </a>
                            <a class="portfolio-btn" href="<?php echo $image['sizes']['large']; ?>" data-lightbox="portfolio">
                                <i class="bi bi-plus text-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
                        <div class="position-relative portfolio-box">
                            <?php $image = get_field('tab_nizhnie_izobrazhenie_3', $post_id); ?>
                            <img class="img-fluid w-100" src="<?php echo $image['sizes']['large']; ?>" alt="">
                            <a class="portfolio-title shadow-sm" href="">
                                <p class="h4 text-uppercase"><?php echo the_field('zagolovok_nizhnego_izobrazhenie_3', $post_id); ?></p>
                                <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                            </a>
                            <a class="portfolio-btn" href="<?php echo $image['sizes']['large']; ?>" data-lightbox="portfolio">
                                <i class="bi bi-plus text-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
                        <div class="position-relative portfolio-box">
                            <?php $image = get_field('tab_nizhnie_izobrazhenie_4', $post_id); ?>
                            <img class="img-fluid w-100" src="<?php echo $image['sizes']['large']; ?>" alt="">
                            <a class="portfolio-title shadow-sm" href="">
                                <p class="h4 text-uppercase"><?php echo the_field('zagolovok_nizhnego_izobrazhenie_4', $post_id); ?></p>
                                <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                            </a>
                            <a class="portfolio-btn" href="<?php echo $image['sizes']['large']; ?>" data-lightbox="portfolio">
                                <i class="bi bi-plus text-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item first">
                        <div class="position-relative portfolio-box">
                            <?php $image = get_field('tab_nizhnie_izobrazhenie_5', $post_id); ?>
                            <img class="img-fluid w-100" src="<?php echo $image['sizes']['large']; ?>" alt="">
                            <a class="portfolio-title shadow-sm" href="">
                                <p class="h4 text-uppercase"><?php echo the_field('zagolovok_nizhnego_izobrazhenie_5', $post_id); ?></p>
                                <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                            </a>
                            <a class="portfolio-btn" href="<?php echo $image['sizes']['large']; ?>" data-lightbox="portfolio">
                                <i class="bi bi-plus text-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-6 portfolio-item second">
                        <div class="position-relative portfolio-box">
                            <?php $image = get_field('tab_nizhnie_izobrazhenie_6', $post_id); ?>
                            <img class="img-fluid w-100" src="<?php echo $image['sizes']['large']; ?>" alt="">
                            <a class="portfolio-title shadow-sm" href="">
                                <p class="h4 text-uppercase"><?php echo the_field('zagolovok_nizhnego_izobrazhenie_6', $post_id); ?></p>
                                <span class="text-body"><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</span>
                            </a>
                            <a class="portfolio-btn" href="<?php echo $image['sizes']['large']; ?>" data-lightbox="portfolio">
                                <i class="bi bi-plus text-white"></i>
                            </a>
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
    </div>
    <!-- Portfolio End -->


    <!-- Team Start -->
    <?php get_template_part('template-parts/single', 'workers') ?>

    <!-- Team End -->


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


    <!-- Blog Start -->

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
                'numberposts' => -1,
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
    <!-- Blog End -->



    <div id="popup" class="popup ">
        <div class="popup__body">
            <div class="popup__content">
                <div class="col-lg-8 bg-light">
                    <div class=" text-center p-5">

                        <?php echo do_shortcode('[contact-form-7 id="45cbafe" title="Без названия"]'); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer() ?>