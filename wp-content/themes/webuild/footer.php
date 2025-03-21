<!-- Footer Start -->
<div class="footer container-fluid position-relative bg-dark bg-light-radial text-white-50 py-6 px-5">
    <div class="row g-5">
        <div class="col-lg-6 pe-lg-5 position-relative ">
            <a href="<?= home_url('/') ?>" class="navbar-brand">
                <h1 class="m-0 display-4 text-uppercase text-white"><i class="bi bi-building text-primary me-2"></i>
                    <?php bloginfo('name'); ?>
                </h1>
            </a>
            <?php
            // указываем категорию 9 и выключаем разбиение на страницы (пагинацию)
            $query = new WP_Query('cat=32&nopaging=1');
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    $query->the_post();
            ?>
                    <?php the_content();
                    ?>
            <?php
                }
                wp_reset_postdata(); // сбрасываем переменную $post
            } else
                echo 'Записей нет.';
            ?>

            <p><i class="fa fa-map-marker-alt me-2 mb-3"></i> <?php $address = get_theme_mod('webuild_address') ?>
                <span><?= $address ?></span>
            </p>
            <p><i class="fa fa-phone-alt me-2 mb-3"></i><?php $phone = get_theme_mod('webuild_phone') ?>
                <span><?= $phone ?></span>
            </p>
            <p><i class="fa fa-envelope me-2 mb-3"></i><?php //$email = get_theme_mod('webuild_email') 
                                                        ?>
                <!-- <span><?= $email ?></span> -->

                <?php echo esc_attr(get_option('webuild_email', 'venzil@mail.ru') ?: 'Не указан') ?>
            </p>

        </div>
        <div class="col-lg-6 ps-lg-5 footer-link">
            <div class="row g-5">
                <div class="col-sm-6">
                    <h4 class="text-white text-uppercase mb-4">Быстрые ссылки</h4>
                    <?php
                    wp_nav_menu(
                        [
                            'theme_location' => 'footer-menu',
                            'container' => '',


                        ]
                    ); ?>

                </div>
                <div class="col-sm-6">
                    <h4 class="text-white text-uppercase mb-4">Популярные ссылки</h4>
                    <?php
                    wp_nav_menu(
                        [
                            'theme_location' => 'footer-menu',
                            'container' => '',


                        ]
                    ); ?>

                </div>
                <div class="col-sm-12">
                    <h4 class="text-white text-uppercase mb-4">Информационный бюллетень</h4>

                    <?= do_shortcode('[contact-form-7 id="617a4b1" title="footer-email"]'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid bg-dark bg-light-radial text-white border-top border-primary px-0">
    <div class="d-flex flex-column flex-md-row justify-content-between">
        <div class="py-4 px-5 text-center text-md-start">
            <p class="mb-0">&copy; <a class="text-primary" href="#">Your Site Name</a>. Все права защищены.</p>
        </div>
        <div class="py-4 px-5 bg-primary footer-shape position-relative text-center text-md-end">
            <p class="mb-0">Разработано <a class="text-dark ms-3" href="https://farhadsite.ru">HTML-код</a></p>
        </div>
    </div>

</div>
<!-- Footer End -->


<!-- Back to Top -->
<a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


<?php wp_footer(); ?>
</body>

</html>