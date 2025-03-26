<?php

/**
 * WEBUILD functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WEBUILD
 */

if (!defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}
function wfmtest_debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */

function wfmtest_post_thumb($id, $size = 'full', $wrapper_class = 'card-thumb ')
{
    //	global $post;
    $html = '<div class="' . $wrapper_class . '">';
    if (has_post_thumbnail()) {
        $html .= get_the_post_thumbnail($id, $size);
    } else {
        $html .= '<img src="https://loremflickr.com/320/240/paris,girl/all" alt="" width="1200" height="900">';
    }
    $html .= '</div>';

    return $html;
}


function webuild_setup()
{
    /*
     * Make theme available for translation.
     * Translations can be filed in the /languages/ directory.
     * If you're building a theme based on WEBUILD, use a find and replace
     * to change 'webuild' to the name of your theme in all the template files.
     */
    load_theme_textdomain('webuild', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'header-top' => esc_html__('Header top', 'webuild'),
            'header-bottom' => esc_html__('Header bottom', 'webuild'),
            'footer-menu' => esc_html__('footer', 'webuild'),
        )
    );

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'webuild_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height' => 68,
            'width' => 315,
            'flex-width' => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'webuild_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function webuild_content_width()
{
    $GLOBALS['content_width'] = apply_filters('webuild_content_width', 640);
}
add_action('after_setup_theme', 'webuild_content_width', 0);

add_theme_support('post-formats', array('aside', 'gallery', 'video', 'link'));
// включаем поддержку форматов постов для страниц 'page'
// add_post_type_support('page', 'post-formats');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function webuild_widgets_init()
{
    register_sidebar(
        array(
            'name' => esc_html__('Sidebar', 'webuild'),
            'id' => 'sidebar-1',
            'description' => esc_html__('Add widgets here.', 'webuild'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget' => '</section>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        )
    );
}
add_action('widgets_init', 'webuild_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function webuild_scripts()
{
    //Google Web Fonts
    // wp_enqueue_style( 'webuild-fonts', 'https://fonts.gstatic.com' );
    wp_enqueue_style('webuild-google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap');

    //Icon Font Stylesheet
    wp_enqueue_style('webuild-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css');
    wp_enqueue_style('webuild-bootstrapicons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css');

    //Libraries Stylesheet
    wp_enqueue_style('webuild-owlcarousel', get_template_directory_uri() . '/lib/owlcarousel/assets/owl.carousel.min.css');
    wp_enqueue_style('webuild-tempusdominus', get_template_directory_uri() . '/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css');
    wp_enqueue_style('webuild-lightbox', get_template_directory_uri() . "/lib/lightbox/css/lightbox.min.css", array(), _S_VERSION);

    //Customized Bootstrap Stylesheet
    wp_enqueue_style('webuild-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('webuild-swiper', get_template_directory_uri() . '/css/swiper-bundle.min.css');

    //Template Stylesheet
    wp_enqueue_style('webuild-popup', get_template_directory_uri() . "/css/popup.css");
    wp_enqueue_style('webuild-style', get_template_directory_uri() . "/css/style.css");
    wp_enqueue_style('theme-style', get_stylesheet_uri());

    // wp_style_add_data( 'webuild-style', 'rtl', 'replace' );

    wp_deregister_script('jquery');
    wp_register_script('jquery', "https://code.jquery.com/jquery-3.4.1.min.js");
    wp_enqueue_script('jquery');
    wp_enqueue_script('webuild-jsdelivr', "https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js", array(), _S_VERSION, true);
    wp_enqueue_script('webuild-easing', get_template_directory_uri() . "/lib/easing/easing.min.js", array(), _S_VERSION, true);
    wp_enqueue_script('webuild-waypoints', get_template_directory_uri() . "/lib/waypoints/waypoints.min.js", array(), _S_VERSION, true);
    wp_enqueue_script('webuild-owlcarousel', get_template_directory_uri() . "/lib/owlcarousel/owl.carousel.min.js", array(), _S_VERSION, true);
    wp_enqueue_script('webuild-tempusdominus', get_template_directory_uri() . "/lib/tempusdominus/js/moment.min.js", array(), _S_VERSION, true);
    wp_enqueue_script('webuild-timezone', get_template_directory_uri() . "/lib/tempusdominus/js/moment-timezone.min.js", array(), _S_VERSION, true);
    wp_enqueue_script('webuild-bootstrap', get_template_directory_uri() . "/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js", array(), _S_VERSION, true);
    wp_enqueue_script('webuild-isotope', get_template_directory_uri() . "/lib/isotope/isotope.pkgd.min.js", array(), _S_VERSION, true);
    wp_enqueue_script('webuild-lightbox', get_template_directory_uri() . "/lib/lightbox/js/lightbox.min.js", array(), _S_VERSION, true);
    wp_enqueue_script('webuild-swiper', get_template_directory_uri() . "/js/swiper-bundle.min.js", array(), _S_VERSION, true);

    wp_enqueue_script('webuild-popup', get_template_directory_uri() . "/js/popup.js", [], _S_VERSION, true);
    wp_enqueue_script('webuild-main', get_template_directory_uri() . "/js/main.js", array(), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'webuild_scripts');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/Metabox.php';
require get_template_directory() . '/inc/customize.php';
require get_template_directory() . '/inc/admin-function.php';



/**
 * Menu Walker
 */
require get_template_directory() . '/inc/webuild_Menu.php';

/**
 * shortcode
 */
require get_template_directory() . './shortcode.php';


// require get_template_directory() . '/admin.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

function webuild_post_thumb($id, $size = 'full', $wrapper_class = 'card-thumb ')
{
    //    global $post;
    $html = '<div class="' . $wrapper_class . '">';
    if (has_post_thumbnail()) {
        $html .= get_the_post_thumbnail($id, $size);
    } else {
        $html .= '<img src="https://loremflickr.com/320/240/paris,girl/all" alt="" width="600" height="500">';
    }
    $html .= '</div>';

    return $html;
}
// add_filter( 'nav_menu_css_class', 'change_menu_item_css_classes', 10, 4 );

// function change_menu_item_css_classes( $classes, $item, $args, $depth ) {
//     if( 29 === $item->ID  && 'header-bottom' === $args->theme_location ){
//         $classes[] = 'bg-primary text-white px-5 ms-3 d-none d-lg-block ';

//     }
//     return $classes;

// }


//выводит видео
function webuild_get_media($types = array())
{
    $content = apply_filters('the_content', get_the_content());
    $items = get_media_embedded_in_content($content, $types);
    return $items[0] ?? $items;
}

add_filter('my_action', fn() => 'привет мир');

// add_action('the_content', 'modify_the_content');

// function modify_the_content($post_content)
// {
//     return '<div class="custom-block">' . $post_content . '</div>';
// }

add_shortcode('my_short', 'short_function');



add_shortcode('icon', 'building_icon');
function building_icon($atts)
{
    $atts = shortcode_atts(array(), $atts);

    return '<i class="fa fa-3x fa-building text-primary"></i>';
}


// хук для регистрации
add_action('init', 'create_taxonomy');
function create_taxonomy()
{

    register_taxonomy('skills', ['Рисование'], [
        'label'                 => '', // определяется параметром $labels->name
        'labels'                => [
            'name'              => 'Genres',
            'singular_name'     => 'Genre',
            'search_items'      => 'Search Genres',
            'all_items'         => 'All Genres',
            'view_item '        => 'View Genre',
            'parent_item'       => 'Parent Genre',
            'parent_item_colon' => 'Parent Genre:',
            'edit_item'         => 'Edit Genre',
            'update_item'       => 'Update Genre',
            'add_new_item'      => 'Add New Genre',
            'new_item_name'     => 'New Genre Name',
            'menu_name'         => 'Genre',
            'back_to_items'     => '← Back to Genre',
        ],
        'description'           => 'Навыки', // описание таксономии
        'public'                => true,
        // 'publicly_queryable'    => null, // равен аргументу public
        // 'show_in_nav_menus'     => true, // равен аргументу public
        // 'show_ui'               => true, // равен аргументу public
        // 'show_in_menu'          => true, // равен аргументу show_ui
        // 'show_tagcloud'         => true, // равен аргументу show_ui
        // 'show_in_quick_edit'    => null, // равен аргументу show_ui
        'hierarchical'          => false,

        'rewrite'               => true,
        //'query_var'             => $taxonomy, // название параметра запроса
        'capabilities'          => array(),
        'meta_box_cb'           => null, // html метабокса. callback: `post_categories_meta_box` или `post_tags_meta_box`. false — метабокс отключен.
        'show_admin_column'     => false, // авто-создание колонки таксы в таблице ассоциированного типа записи. (с версии 3.5)
        'show_in_rest'          => null, // добавить в REST API
        'rest_base'             => null, // $taxonomy
        // '_builtin'              => false,
        //'update_count_callback' => '_update_post_term_count',
    ]);
}

function debug($data)
{
    echo '<pre>' . print_r($data, 1) . '</pre>';
}



add_filter('the_content', 'do_shortcode', 11);


function wfmtest_custom_init()
{
    register_post_type('workers', array(
        'labels' => array(
            'name'          => 'Работники',
            'singular_name' => 'Работник',
            'all_items'     => 'Все работники',
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-universal-access-alt',
    ));
}

add_action('init', 'wfmtest_custom_init');

// записи клиенты
function klienty_custom_init()
{
    register_post_type('klienty', array(
        'labels' => array(
            'name'          => 'Клиенты',
            'singular_name' => 'Клиент',
            'all_items'     => 'Все Клиенты',
        ),
        'public' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'show_in_rest' => true,
        'menu_position' => 7,
        'menu_icon' => 'dashicons-money',
    ));
}

add_action('init', 'klienty_custom_init');

function custom_post_type()
{

    // Set UI labels for Custom Post Type
    $labels = array(
        'name'                => _x('Слайдеры', 'Post Type General Name', 'webuild'),
        'singular_name'       => _x('Слайдеры', 'Post Type Singular Name', 'webuild'),
        'menu_name'           => __('Слайдеры', 'webuild'),
        'parent_item_colon'   => __('Parent Movie', 'webuild'),
        'all_items'           => __('Все сайды', 'webuild'),
        'view_item'           => __('View Movie', 'webuild'),
        'add_new_item'        => __('Добавить новый слайд', 'webuild'),
        'add_new'             => __('Add New', 'webuild'),
        'edit_item'           => __('Редактировать слайд', 'webuild'),
        'update_item'         => __('Update Movie', 'webuild'),
        'search_items'        => __('Search Movie', 'webuild'),
        'not_found'           => __('Не найдено', 'webuild'),
        'not_found_in_trash'  => __('Не найдено в корзине', 'webuild'),
    );

    // Set other options for Custom Post Type

    $args = array(
        'label'               => __('slider', 'webuild'),
        'description'         => __('Movie news and reviews', 'webuild'),
        'labels'              => $labels,
        'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 6,
        'menu_icon' => 'dashicons-images-alt2',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'page',

        // This is where we add taxonomies to our CPT
        'taxonomies'          => array('category'),
    );

    // Registering your Custom Post Type
    register_post_type('slider', $args);
}

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query)
{
    if (is_category()) {
        $post_type = get_query_var('post_type');
        if ($post_type)
            $post_type = $post_type;
        else
            $post_type = array('nav_menu_item', 'post', 'slider'); // don't forget nav_menu_item to allow menus to work!
        $query->set('post_type', $post_type);
        return $query;
    }
}

/* Hook into the 'init' action so that the function
    * Containing our post type registration is not 
    * unnecessarily executed. 
    */

add_action('init', 'custom_post_type', 0);

// *********************************

// function custom_init()
// {

//     // Set UI labels for Custom Post Type
//     $labels = array(
//         'name'                => _x('Проекты', 'Post Type General Name', 'webuild'),
//         'singular_name'       => _x('Проекты', 'Post Type Singular Name', 'webuild'),
//         'menu_name'           => __('Проекты', 'webuild'),
//         'parent_item_colon'   => __('Parent Movie', 'webuild'),
//         'all_items'           => __('Все проекты', 'webuild'),
//         'view_item'           => __('View Movie', 'webuild'),
//         'add_new_item'        => __('Добавить новый проект', 'webuild'),
//         'add_new'             => __('Add New', 'webuild'),
//         'edit_item'           => __('Редактировать проект', 'webuild'),
//         'update_item'         => __('Update Movie', 'webuild'),
//         'search_items'        => __('Search Movie', 'webuild'),
//         'not_found'           => __('Не найдено', 'webuild'),
//         'not_found_in_trash'  => __('Не найдено в корзине', 'webuild'),
//     );

//     // Set other options for Custom Post Type

//     $args = array(
//         'label'               => __('project', 'webuild'),
//         'description'         => __('Movie news and reviews', 'webuild'),
//         'labels'              => $labels,
//         'supports'            => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields',),
//         'hierarchical'        => false,
//         'public'              => true,
//         'show_ui'             => true,
//         'show_in_menu'        => true,
//         'show_in_nav_menus'   => true,
//         'show_in_admin_bar'   => true,
//         'menu_position'       => 2,
//         'can_export'          => true,
//         'has_archive'         => true,
//         'exclude_from_search' => false,
//         'publicly_queryable'  => true,
//         'capability_type'     => 'page',

//         // This is where we add taxonomies to our CPT
//         'taxonomies'          => array('category'),
//     );

//     // Registering your Custom Post Type
//     register_post_type('project', $args);
// }

// add_filter('pre_get_posts', 'custom_init_post_type');
// function custom_init_post_type($query)
// {
//     if (is_category()) {
//         $post_type = get_query_var('post_type');
//         if ($post_type)
//             $post_type = $post_type;
//         else
//             $post_type = array('nav_menu_item', 'post', 'project'); // don't forget nav_menu_item to allow menus to work!
//         $query->set('post_type', $post_type);
//         return $query;
//     }
// }

// /* Hook into the 'init' action so that the function
//     * Containing our post type registration is not 
//     * unnecessarily executed. 
//     */

// add_action('init', 'custom_init', 0);



// Добавление span в текст
function reviewsText()
{
    $reviews_text = get_the_title();
    $liderTitle = explode(" ", $reviews_text);
    $liderTitle[2] = "<span>$liderTitle[2]</span>";
    $reviews_title = implode(' ', $liderTitle);
    return $reviews_title;
}
function cat_description()
{
    $cat_id = 31;
    $cat_description = category_description($cat_id);
    $liderTitle = explode(" ", $cat_description);
    $liderTitle[1] = "<span>$liderTitle[1]</span>";
    $reviews_title = implode(' ', $liderTitle);
    return $reviews_title;
}

function servicesText()
{
    $services_text = get_the_title(418);
    $servicesTitle = explode(" ", $services_text);
    $servicesTitle[2] = "<span>$servicesTitle[2]</span>";
    $services_title = implode(' ', $servicesTitle);
    return $services_title;
}
function contaсtText()
{
    $services_text = get_the_title(49);
    $servicesTitle = explode(" ", $services_text);
    $servicesTitle[1] = "<span>$servicesTitle[1]</span>";
    $services_title = implode(' ', $servicesTitle);
    return $services_title;
}
function klientyText()
{
    $services_text = get_the_title(670);
    $servicesTitle = explode(" ", $services_text);
    $servicesTitle[2] = '<span>' . $servicesTitle[2] . '</span>';
    $servicesTitle[3] = '<span>' . $servicesTitle[3] . '</span>';
    $services_title = implode(' ', $servicesTitle);
    return $services_title;
}

function workersText()
{
    $specific_post = get_post(614);
    $specific_text = get_the_title($specific_post);
    $servicesTitle = explode(" ", $specific_text);
    $servicesTitle[1] = '<span>' . $servicesTitle[1] . '</span>';
    $services_title = implode(' ', $servicesTitle);
    return $services_title;
}
function blogText()
{
    $blogText_post = get_cat_name(31);
    $servicesTitle = explode(" ", $blogText_post);
    $servicesTitle[1] = '<span>' . $servicesTitle[1] . '</span>';
    $services_title = implode(' ', $servicesTitle);
    return $services_title;
}



// Приветствие в админке
add_action('login_header', 'add_custom_block_to_login_header');

function add_custom_block_to_login_header()
{
?>
    <div class="custom-block">
        <p>Рады приветствовать на нашем сайте!</p>
    </div>

<?php
}


// admin
/* ============================
    Редирект с wp-admin
=========================== */

add_action('init', 'blockusers_init');

function blockusers_init()
{
    if (
        is_admin() && ! current_user_can('administrator') &&
        ! (defined('DOING_AJAX') && DOING_AJAX)
    ) {
        wp_redirect(home_url());
        exit;
    }
}




/* ============================
    Редирект с wp-login.php
=========================== */

add_action('init', 'redirect_login_page');


function redirect_login_page()
{
    $page_viewed = basename($_SERVER['REQUEST_URI']);
    $result = strpos($page_viewed, 'wp-login.php');


    if ($result !== false) {
        wp_redirect(home_url('/404/'));
        exit;
    }
}


/* ============================
    Смена адресов на новый
=========================== */

add_filter('site_url', 'wplogin_filter', 10, 3);

function wplogin_filter($url, $path, $orig_scheme)
{
    $old = array("/(wp-login.php)/");
    $new = array("far.php");
    return preg_replace($old, $new, $url, 1);
}


// remove_filter('the_content', 'wpautop');
// add_filter('the_content', 'wpautop', 12);


# Включаем вывод кастомных стилей для редактора блоков
add_action('after_setup_theme', 'gutenberg_setup_theme');
function gutenberg_setup_theme()
{
    // файл стилей для редактора блоков
    add_theme_support('editor-styles'); // включает поддержку
    add_editor_style();                   // добавляет файл стилей editor-style.css
}

add_filter('wp_nav_menu_items', 'add_new_menu_item', 10, 2);
function add_new_menu_item($nav, $args)
{
    if ($args->theme_location == 'primary') {
        if (is_front_page()) {
            $my_link_class = "home-link current-menu-item";
        } else {
            $my_link_class = "home-link";
        }
        $newmenuitem = '<li class="' . $my_link_class . '"><a href="' . home_url() . '"><img src="' . get_stylesheet_directory_uri() . '/img/home-white25.png"></a></li>';
        $nav = $newmenuitem . $nav;
    }
    return $nav;
}
// удаление тега p
add_filter('wpcf7_autop_or_not', '__return_false');

// function add_custom_post_class($classes)
// {
//     if (is_single()) {
//         $classes[] = 'single-post';
//     }
//     return $classes;
// }
// add_filter('post_class', 'add_custom_post_class');

// подключаем функцию активации мета блока (my_extra_fields)

Remove_filter('the_content', 'wpautop');
Remove_filter('the_excerpt', 'wpautop');

add_image_size('spec_thumb', 50, 70, true);


// function change_comment_fields_order($fields)
// {
//     // Сохраним поле комментария во временной переменной
//     $comment_field = $fields['comment'];

//     // Меняем местами
//     $fields['comment'] = $fields['author']; // Поле автора становится полем комментария
//     $fields['author'] = $comment_field; // Поле комментария становится полем автора

//     return $fields;
// }

// add_filter('comment_form_default_fields', 'change_comment_fields_order');

// function custom_comment_fields_order($fields)
// {
//     // Сохраняем ссылку на текущее поле комментария
//     $comment_field = $fields['comment'];
//     // Теперь удаляем поле комментариев
//     unset($fields['comment']);
//     // Сохраняем поле автора
//     $name_field = $fields['author'];
//     // Теперь меняем порядок
//     $fields = array(
//         'comment' => $comment_field,
//         'author' => $name_field,
//     );
//     return $fields;
// }

// add_filter('comment_form_fields', 'custom_comment_fields_order');

function custom_comment_fields_order($fields)
{
    // Проверяем, существует ли поле комментария
    if (isset($fields['comment'])) {
        // Сохраняем ссылку на текущее поле комментария
        $comment_field = $fields['comment'];
        // Теперь удаляем поле комментариев
        unset($fields['comment']);
    }

    // Проверяем, существует ли поле автора
    if (isset($fields['author'])) {
        // Сохраняем поле автора
        $name_field = $fields['author'];
        // Удаляем поле автора, чтобы изменить порядок
        unset($fields['author']);
    }
    // Проверяем, существует ли поле url
    if (isset($fields['url'])) {
        // Сохраняем поле автора
        $url_field = $fields['url'];
        // Удаляем поле автора, чтобы изменить порядок
        unset($fields['url']);
    }

    // Меняем порядок, добавляя комментарий и затем автора
    $fields = array(
        'author' => isset($name_field) ? $name_field : '', // Добавляем поле автора, если оно существует
        'url' => isset($url_field) ? $url_field : '', // Добавляем поле автора, если оно существует
        'comment' => isset($comment_field) ? $comment_field : '', // Добавляем поле комментария, если оно существует
    );

    return $fields;
}

add_filter('comment_form_fields', 'custom_comment_fields_order');

function custom_comment_form_fields($fields)
{
    // Объединение полей author и email в один ряд
    $fields['author'] = '<p class="comment-form-author-email">' .
        '<input id="author" name="author" placeholder="Ваше имя"  type="text" value="" size="40" />' .
        '<input id="email" name="email" placeholder="Ваш email"  type="email" value="" size="40" />' .
        '</p>';

    // Удаляем оригинальные поля author и email
    unset($fields['email']);

    return $fields;
}
add_filter('comment_form_default_fields', 'custom_comment_form_fields');

function custom_comment_form_defaults($fields)
{
    // Удаляем label из поля для имени
    if (isset($fields['author'])) {
        $fields['author'] = str_replace('<label for="author">', '', $fields['author']);
        $fields['author'] = str_replace('</label>', '', $fields['author']);
        $fields['author'] = str_replace('value=', 'placeholder="Ваше имя" value=', $fields['author']);
    }

    // Удаляем label из поля для url
    if (isset($fields['url'])) {

        $fields['url'] = str_replace('value=', 'placeholder="Сайт" value=', $fields['url']);
    }

    // Удаляем label из поля для комментария
    if (isset($fields['comment'])) {
        $fields['comment'] = str_replace('<label for="comment">', '', $fields['comment']);
        $fields['comment'] = str_replace('</label>', '', $fields['comment']);
        $fields['comment'] = str_replace('value=', 'placeholder="Ваш комментарий" value=', $fields['comment']);
    }

    return $fields;
}
add_filter('comment_form_default_fields', 'custom_comment_form_defaults');

function custom_comment_field($field)
{
    // Проверяем, не является ли $field null
    if ($field === null) {
        return $field; // Если null, возвращаем его без изменений
    }

    // Удаляем тег label
    $field = preg_replace('#<label for="comment".*?</label>#', '', $field);

    // Добавляем атрибут placeholder
    $field = str_replace('textarea', 'textarea placeholder="Ваш комментарий"', $field);



    return $field;
}
add_filter('comment_form_field_comment', 'custom_comment_field');
function custom_url_field($field)
{
    // Проверяем, не является ли $field null
    if ($field === null) {
        return $field; // Если null, возвращаем его без изменений
    }

    // Удаляем тег label
    $field = preg_replace('#<label for="url".*?</label>#', '', $field);

    // Добавляем атрибут placeholder
    $field = str_replace('url', ' placeholder="Ваш"', $field);

    return $field;
}
add_filter('comment_form_field_url', 'custom_url_field');

// function h_comment_form_field_cookies($cookies)
// {
//     $cookies = '
//  <p class="comment-form-personal-information">
//  Нажимая кнопку "Отправить", я даю согласие на 
//  обработку персональных данных в соответствии 
//  с политикой в области обработки и защиты
//  персональных данных.
//  </p>';
//     return $cookies;
// }
