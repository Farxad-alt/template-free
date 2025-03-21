<?php
/*
Template Name: Обратный звонок
Template Post Type: post
*/
?>
<?php
global $post;

$myposts = get_posts([
    'numberposts' => -1,
    'category_name'    => 'call-back',

]);
?>
<?php if (is_page('about')) : ?>
    <div class="container-fluid py-6 px-5 bg-light">
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
<?php else: ?>
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

            <div class="col-lg-8">
                <div class="bg-light text-center p-5">

                    <?php echo do_shortcode('[contact-form-7 id="45cbafe" title="Без названия"]'); ?>

                </div>
            </div>

        </div>
    </div>
<?php endif; ?>