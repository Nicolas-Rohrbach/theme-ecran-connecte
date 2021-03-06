<?php

include_once 'inc/customizer/custom_colors.php';
include_once 'inc/customizer/custom_sidebar.php';
include_once 'inc/customizer/custom_schedule.php';
include_once 'inc/customizer/custom_footer.php';

add_filter('auto_update_plugin', '__return_true');
add_filter('auto_update_theme', '__return_true');


error_reporting(0);
/*
function wp_maintenance_mode()
{
	if(!current_user_can('edit_themes') || !is_user_logged_in()) {
		wp_die('<h1 style="color:red">Site en maintenance</h1>
<br />Le site est en cours de maintenance, merci de bien patienter
<script src="/wp-content/themes/theme-ecran-connecte/assets/js/refresh.js"></script>');
	}
}
add_action('get_header', 'wp_maintenance_mode');
*/


/**
 * Load all scripts (CSS / JS)
 */
function add_theme_scripts()
{
    wp_enqueue_style('bootstrap-style', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', false, '', 'all');
    //wp_enqueue_style('reset-style', get_template_directory_uri() . '/reset.css', false, '1.0', 'all');
    wp_enqueue_style('main-style', get_template_directory_uri() . '/style.css', false, '1.0', 'all');
    wp_enqueue_style('header-style', get_template_directory_uri() . '/assets/css/header.css', false, '1.0', 'all');
    wp_enqueue_style('content-style', get_template_directory_uri() . '/assets/css/content.css', false, '1.0', 'all');
    wp_enqueue_style('sidebar-style', get_template_directory_uri() . '/assets/css/sidebar.css', false, '1.0', 'all');
    wp_enqueue_style('footer-style', get_template_directory_uri() . '/assets/css/footer.css', false, '1.0', 'all');
    wp_enqueue_script( 'theme-jquery', get_template_directory_uri() . '/assets/js/vendor/jquery-3.3.1.min.js', array (), '', false);
    wp_enqueue_script( 'theme-jqueryUI', get_template_directory_uri() . '/assets/js/vendor/jquery-ui.min.js', array ( 'jquery' ), '', false);
    wp_enqueue_script('theme-menu', get_template_directory_uri() . '/assets/js/menu.js', array('jquery'), '', false);
    wp_enqueue_script('theme-popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js', array(), '', true);
    wp_enqueue_script('theme-bootstrapjs', 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js', array(), '', true);
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');

/**
 * CSS admin
 */
function admin_css()
{

    $admin_handle = 'admin_css';
    $admin_stylesheet = get_template_directory_uri() . '/assets/css/admin.css';

    wp_enqueue_style($admin_handle, $admin_stylesheet);
}

add_action('admin_print_styles', 'admin_css', 11);

/**
 * Change the image for the logo
 */
function my_login_logo()
{ ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri()."/assets/images/logo.png" ?>);
            height: 65px;
            width: 320px;
            background-size: 120px 120px;
            background-repeat: no-repeat;
            padding-bottom: 60px;
        }
    </style>
<?php }

add_action('login_enqueue_scripts', 'my_login_logo');

/**
 * CSS for login page
 */
function my_login_stylesheet()
{
    wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/assets/css/login.css');
}

add_action('login_enqueue_scripts', 'my_login_stylesheet');

//Met la bonne heure
global $wpdb;
date_default_timezone_set('Europe/Paris');
$wpdb->time_zone = 'Europe/Paris';

/**
 * Remove the wordpress bar
 */
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar()
{
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

/**
 * Disable the url /wp-admin except for the admin
 */
add_action('init', 'wpm_admin_redirection');
function wpm_admin_redirection()
{
    //Si on essaye d'accéder à L'administration Sans avoir le rôle administrateur
    if (is_admin() && !current_user_can('administrator')) {
        // On redirige vers la page d'accueil
        wp_redirect(home_url());
        exit;
    }
}

/**
 * Change the url of the logo
 * @return mixed
 */
function my_login_logo_url()
{
    return $_SERVER['HTTP_HOST'];
}

add_filter('login_headerurl', 'my_login_logo_url');

/**
 * Change the title of the logo
 *
 * @return string
 */
function my_login_logo_url_title()
{
    return get_bloginfo('name');
}
add_filter('login_headertitle', 'my_login_logo_url_title');

$args = array(
    'width' => 345,
    'height' => 100,
    'default-image' => get_template_directory_uri() . 'assets/images/header.png',
    'uploads' => true,
);
add_theme_support('custom-header', $args);

$args = array(
    'default-color' => '#ffffff',
    'default-image' => '%1$s/images/background.jpg',
);
add_theme_support('custom-background', $args);

$args = array(
    'default-color' => '#ffffff',
    'default-image' => '%1$s/images/background.jpg',
);
add_theme_support('custom-header-background', $args);

// All sidebars
if (function_exists('register_sidebar')) {
    register_sidebar(array(
        'name' => 'Header',
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => 'Footer',
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer gauche',
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Footer droite',
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Colonne Gauche',
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    register_sidebar(array(
        'name' => 'Colonne Droite',
        'before_widget' => '<li>',
        'after_widget' => '</li>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
}
