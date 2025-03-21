<div class="wrap">
    <h1>Главная страница опций темы</h1>

    <form action="options.php" method="post">

        <?php settings_fields('webuild_general_group'); ?>

        <?php do_settings_sections('webuild-options'); ?>

        <?php submit_button(); ?>

    </form>

</div>