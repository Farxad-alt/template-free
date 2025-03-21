<div class="col-lg-4 col-md-6">
    <div <?php post_class("service-item bg-white d-flex flex-column align-items-center text-center"); ?>>

        <!-- <div class="service-item bg-white d-flex flex-column align-items-center text-center"> -->
        <?php echo webuild_post_thumb(get_the_ID(), 'full', 'card-full-thumb') ?>
        <div class="service-icon bg-white home-icon">
            <?php

            $content_shortcoded = do_shortcode(get_the_content());
            echo $content_shortcoded;
            ?>

        </div>
        <div class="px-4 pb-4">
            <?php

            ?>
            <h4 class="text-uppercase mb-3"><?php the_title(); ?></h4>


            <p>

                <?php

                $maxchar = 100;
                $text = strip_tags(get_the_excerpt());
                echo ltrim(mb_substr($text, 0, $maxchar));
                ?></p>
            <a class="btn text-primary" href="<?php the_permalink(); ?>">Читать далее <i class="bi bi-arrow-right"></i></a>
        </div>
    </div>
</div>