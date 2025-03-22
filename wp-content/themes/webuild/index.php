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


    <!-- О нас Start -->
    <?php get_template_part('template-parts/content', 'about') ?>
    <!-- О нас End -->


    <!-- Услуги Start -->
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
    <!-- Услуги End -->


    <!-- Обратный звонок Start -->
    <?php get_template_part('template-parts/single', 'obratnyj-zvonok') ?>
    <!-- Обратный звонок End -->


    <!-- Наши проекты Start -->

    <?php get_template_part('template-parts/content', 'project') ?>
    <!-- Наши проекты End -->


    <!-- Наша команда Start -->
    <?php get_template_part('template-parts/single', 'workers') ?>

    <!-- Наша команда End -->


    <!-- Клиенты Start -->
    <?php get_template_part('template-parts/content', 'klienty') ?>
    <!-- Клиенты End -->


    <!-- Наши блоги Start -->

    <?php require get_template_directory() . '/category-grid.php'; ?>


    <!-- Наши блоги End -->



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