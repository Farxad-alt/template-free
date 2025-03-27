<?php get_header() ?>


<!-- Page Header Start -->
<div class="container-fluid page-header">
    <h1 class="display-3 text-uppercase text-white mb-3">Детали блога</h1>
    <div class="d-inline-flex text-white">
        <h6 class="text-uppercase m-0"><a href="">Главная</a></h6>
        <h6 class="text-white m-0 px-3">/</h6>
        <h6 class="text-uppercase text-white m-0 ">Детали блога</h6>
    </div>
</div>
<!-- Page Header Start -->


<!-- Blog Start -->
<div class="container-fluid py-6 px-5">
    <div class="row g-5">
        <div class="col-lg-8">
            <!-- Blog Detail Start -->
            <div class="mb-5">
                <?php the_post_thumbnail("full", array("class" => "blog-img mb-4")); ?>
                <?php the_content(); ?>
            </div>
            <!-- Blog Detail End -->

            <?php //require get_template_directory() . '/comments.php';
            ?>
        </div>

        <!-- Sidebar Start -->
        <?php echo get_sidebar(); ?>
        <!-- Sidebar End -->
    </div>
</div>
<!-- Blog End -->
<?php get_footer() ?>