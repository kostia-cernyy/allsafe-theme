<?php

/**
 * allsafe functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package allsafe
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function allsafe_setup()
{
    /*
        * Make theme available for translation.
        * Translations can be filed in the /languages/ directory.
        * If you're building a theme based on allsafe, use a find and replace
        * to change 'allsafe' to the name of your theme in all the template files.
        */
    load_theme_textdomain('allsafe', get_template_directory() . '/languages');

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
            'header_menu' => esc_html__('Header Menu', 'allsafe'),
            'footer_menu' => esc_html__('Footer Menu', 'allsafe'),
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
            'allsafe_custom_background_args',
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
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'allsafe_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function allsafe_content_width()
{
    $GLOBALS['content_width'] = apply_filters('allsafe_content_width', 640);
}
add_action('after_setup_theme', 'allsafe_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function allsafe_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'allsafe'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'allsafe'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'allsafe_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function allsafe_scripts()
{
    // wp_enqueue_style( 'allsafe-style', get_stylesheet_uri(), array(), _S_VERSION );
    // wp_style_add_data( 'allsafe-style', 'rtl', 'replace' );

    wp_enqueue_script('allsafe-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'allsafe_scripts');

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

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}

/**
 * include file.
 */
function allsafe_assets() {
    wp_enqueue_style(
        'allsafe-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap',
        false
    );

    wp_enqueue_style(
        'allsafe-style',
        get_template_directory_uri() . '/dist/css/main.min.css',
        array(),
        filemtime(get_template_directory() . '/dist/css/main.min.css')
    );

    wp_enqueue_script(
        'allsafe-script',
        get_template_directory_uri() . '/dist/js/main.min.js',
        array(),
        filemtime(get_template_directory() . '/dist/css/main.min.css'),
        true
    );
}
add_action('wp_enqueue_scripts', 'allsafe_assets');

/**
 * add icon svg.
 */
function get_icon($name, $class = '') {
    $file = get_template_directory() . '/assets/img/icons/' . $name . '.svg';

    if (file_exists($file)) {
        $svg = file_get_contents($file);
        return '<span class="icon icon-' . esc_attr($name) . ' ' . esc_attr($class) . '">' . $svg . '</span>';
    }

    return '';
}

/**
 * add phone contacts.
 */
function get_contact_phone() {
	$contacts_page = get_page_by_path('kontakty');
	if ($contacts_page) {
		return get_field('phone', $contacts_page->ID);
	}
	return '';
}

/**
 * translit slug.
 */
function allsafe_custom_remove_accents($text) {
	$map = array(
		'А'=>'A','Б'=>'B','В'=>'V','Г'=>'G','Д'=>'D','Е'=>'E','Ё'=>'E','Ж'=>'Zh',
		'З'=>'Z','И'=>'I','Й'=>'Y','К'=>'K','Л'=>'L','М'=>'M','Н'=>'N','О'=>'O',
		'П'=>'P','Р'=>'R','С'=>'S','Т'=>'T','У'=>'U','Ф'=>'F','Х'=>'H','Ц'=>'Ts',
		'Ч'=>'Ch','Ш'=>'Sh','Щ'=>'Sch','Ъ'=>'','Ы'=>'Y','Ь'=>'','Э'=>'E','Ю'=>'Yu','Я'=>'Ya',
		'а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'zh',
		'з'=>'z','и'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o',
		'п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'ts',
		'ч'=>'ch','ш'=>'sh','щ'=>'sch','ъ'=>'','ы'=>'y','ь'=>'','э'=>'e','ю'=>'yu','я'=>'ya',
	);

	return strtr($text, $map);
}
add_filter('sanitize_title', function($title, $raw_title, $context) {
	if ($context === 'save') {
		$raw_title = allsafe_custom_remove_accents($raw_title);
		$title = sanitize_title_with_dashes($raw_title, '', 'save');
	}
	return $title;
}, 10, 3);

/**
 * add arrow icon menu level.
 */
add_filter('nav_menu_item_title', 'allsafe_menu_arrow', 10, 4);
function allsafe_menu_arrow($title, $item, $args, $depth) {
    if (in_array('menu-item-has-children', $item->classes)) {
        $title .= get_icon('arrow', 'menu-arrow');
    }
    return $title;
}

/**
 * register string translate.
 */
function allsafe_register_strings() {
    if (function_exists('pll_register_string')) {
        pll_register_string('Primary navigation', 'Primary navigation', 'Theme');
        pll_register_string('Mobile navigation', 'Mobile navigation', 'Theme');
        pll_register_string('Open menu', 'Open menu', 'Theme');
        pll_register_string('Close menu', 'Close menu', 'Theme');
        pll_register_string('Go to the next block', 'Go to the next block', 'Theme');
        pll_register_string('Open a submenu', 'Open a submenu', 'Theme');
        pll_register_string('Close the submenu', 'Close the submenu', 'Theme');
        pll_register_string('Write on WhatsApp', 'Write on WhatsApp', 'Theme');
        pll_register_string('Quick Contacts', 'Quick Contacts', 'Theme');
        pll_register_string('Call', 'Call', 'Theme');
    }
}
add_action('init', 'allsafe_register_strings');


/**
 * contacts Phone and Whatsapp.
 */
function allsafe_get_contacts_data() {
	$base_contacts_page = get_page_by_path( 'kontakty' );
	$contacts_page_id = 0;

	if ( $base_contacts_page ) {
		if ( function_exists( 'pll_get_post' ) && function_exists( 'pll_current_language' ) ) {
			$current_lang = pll_current_language( 'slug' );
			$translated_id = pll_get_post( $base_contacts_page->ID, $current_lang );
			$contacts_page_id = $translated_id ? $translated_id : $base_contacts_page->ID;
		} else {
			$contacts_page_id = $base_contacts_page->ID;
		}
	}

	if ( ! $contacts_page_id ) {
		return array(
			'phone' => '',
			'phone_href' => '',
			'whatsapp' => '',
			'whatsapp_href' => '',
			'whatsapp_text' => '',
			'whatsapp_message' => '',
		);
	}

	$phone = get_field( 'phone', $contacts_page_id );
	$whatsapp = get_field( 'whatsapp', $contacts_page_id );
	$whatsapp_text = get_field( 'whatsapp_text', $contacts_page_id );

	return array(
		'phone'            => $phone,
		'phone_href'       => $phone ? preg_replace( '/[^0-9+]/', '', $phone ) : '',
		'whatsapp'         => $whatsapp,
		'whatsapp_href'    => $whatsapp ? preg_replace( '/[^0-9]/', '', $whatsapp ) : '',
		'whatsapp_text'    => $whatsapp_text,
		'whatsapp_message' => $whatsapp_text ? rawurlencode( $whatsapp_text ) : '',
	);
}