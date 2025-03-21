<div class="col-12">
    <!-- <div <?php post_class("service-item bg-white d-flex flex-column align-items-center text-center"); ?>> -->

    <div class="ratio ratio-16x9">
        <?php
        echo webuild_get_media(array('iframe', 'video'));
        ?>
    </div>

    <div class="service-icon bg-white">
        <i class="fa fa-3x fa-building text-primary"></i>
    </div>
    <div class="px-4 pb-4">
        <h4 class="text-uppercase mb-3"><?php the_title() ?></h4>
        <p class=""><?php the_content() ?></p>

    </div>

    <!-- </div> -->
    <?php the_tags() ?>
    <?php the_category() ?>

</div>