<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


    <?php wp_body_open(); ?>
    <div class="hidden">
        <div id="hidden_form" class="popup__content col-lg-8 p-5">
            <?php echo do_shortcode('[contact-form-7 id="45cbafe" title="Без названия"]'); ?>
        </div>
    </div>

    <div id="page" class="site">
        <!-- Topbar Start -->
        <div class="container-fluid px-5 d-none d-lg-block header-top">
            <div class="row gx-5">

                <div class="col-lg-4 text-center py-3">
                    <div class="d-inline-flex align-items-center">
                        <i class="bi bi-geo-alt fs-1 text-primary me-3"></i>
                        <div class="text-start">
                            <h6 class="text-uppercase fw-bold">Наш офис</h6>
                            <?php $address = get_theme_mod('webuild_address') ?>
                            <a href="#" type="address"><?= $address ?></a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center border-start border-end py-3">
                    <div class="d-inline-flex align-items-center">
                        <i class="bi bi-envelope-open fs-1 text-primary me-3"></i>
                        <div class="text-start">
                            <h6 class="text-uppercase fw-bold">Напишите нам по электронной почте</h6>
                            <?php $email = get_theme_mod('webuild_email') ?>
                            <a href="#" type="email"><?= $email ?></a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center py-3">
                    <div class="d-inline-flex align-items-center">
                        <i class="bi bi-phone-vibrate fs-1 text-primary me-3"></i>
                        <div class="text-start">
                            <h6 class="text-uppercase fw-bold">Позвоните нам</h6>
                            <?php $phone = get_theme_mod('webuild_phone') ?>
                            <a href="tel:+<?php echo str_replace([' ', '-', '+'], ['', '', ''], $phone) ?>" type="phone"><?= $phone ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Topbar End -->

        <!-- Navbar Start -->
        <div class="container-fluid sticky-top bg-dark bg-light-radial shadow-sm px-5 pe-lg-0">
            <nav class="navbar navbar-expand-lg bg-dark bg-light-radial navbar-dark py-3 py-lg-0">
                <a href="<?= home_url('/') ?>" class="navbar-brand">
                    <h1 class="m-0 display-4 text-uppercase text-white"><i class="bi bi-building text-primary me-2"></i>
                        <?php bloginfo('name'); ?>
                    </h1>
                </a>

                <div class="navbar-nav ms-lg-auto py-0 ">
                    <?php
                    wp_nav_menu(
                        [
                            'theme_location' => 'header-bottom',

                        ]
                    ); ?>

                    <a href="#hidden_form" class="nav-item nav-link bg-primary text-white px-5  d-none d-lg-block popup_c">Получить предложение <i class="bi bi-arrow-right"></i></a>

                    <!-- <ul class="collapse nav navbar-nav nav-collapse " role="search" id="nav-collapse4">
                    <li><a href="#">Support</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><img class="img-circle" src="https://bootstraptema.ru/snippets/icons/2016/mia/1.png" alt="USER" width="20" />
                            USER <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#">My profile</a></li>
                            <li><a href="#">Favorited</a></li>
                            <li><a href="#">Settings</a></li>
                            <li class="divider"></li>
                            <li><a href="#">Logout</a></li>
                        </ul> -->

                </div>
            </nav>
        </div>
        <!-- Navbar End -->