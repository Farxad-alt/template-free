<div class="col-lg-4 col-md-6">
    <div <?php post_class('service-item bg-white d-flex flex-column align-items-center text-center') ?>>

        <div <?php post_class('card shadow-sm webuild-format-video'); ?>>

            <div class="ratio ratio-16x9">
                <?php
                echo webuild_get_media(array('iframe', 'video'));
                ?>
            </div>

            <div class="service-icon bg-white">
                <i class="fa fa-3x fa-building text-primary"></i>
            </div>
            <div class="px-4 pb-4">
                <h4 class="text-uppercase mb-3"><?php the_title(); ?></h4>

                <a class="btn text-primary" href="<?php the_permalink(); ?>">Читать далее <i class="bi bi-arrow-right"></i></a>
            </div>
        </div>
    </div>
</div>