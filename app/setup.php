<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('sage/main.css', asset_path('styles/main.css'), false, null);
    wp_enqueue_script('sage/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nav-walker');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');

    /**
     * Enable plugins to manage the document title
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Register navigation menus
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
      'primary_navigation' => __('Primary Navigation', 'sage'),
      'mobile_navigation' => __('Mobile Navigation', 'sage'),
      'cart_navigation' => __('Cart Menu', 'sage'),
    ]);

    /**
     * Enable post thumbnails
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable HTML5 markup support
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Enable selective refresh for widgets in customizer
     * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
     */
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Use main stylesheet for visual editor
     * @see resources/assets/styles/layouts/_tinymce.scss
     */
    add_editor_style(asset_path('styles/main.css'));
}, 20);

/**
 * Register sidebars
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3>',
        'after_title'   => '</h3>'
    ];
    register_sidebar([
        'name'          => __('Primary', 'sage'),
        'id'            => 'sidebar-primary'
    ] + $config);
    register_sidebar([
        'name'          => __('Footer', 'sage'),
        'id'            => 'sidebar-footer'
    ] + $config);
});

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action('the_post', function ($post) {
    sage('blade')->share('post', $post);
});

/**
 * Setup Sage options
 */
add_action('after_setup_theme', function () {
    /**
     * Add JsonManifest to Sage container
     */
    sage()->singleton('sage.assets', function () {
        return new JsonManifest(config('assets.manifest'), config('assets.uri'));
    });

    /**
     * Add Blade to Sage container
     */
    sage()->singleton('sage.blade', function (Container $app) {
        $cachePath = config('view.compiled');
        if (!file_exists($cachePath)) {
            wp_mkdir_p($cachePath);
        }
        (new BladeProvider($app))->register();
        return new Blade($app['view']);
    });

    /**
     * Create @asset() Blade directive
     */
    sage('blade')->compiler()->directive('asset', function ($asset) {
        return "<?= " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
    });
});

/**
 * This is a exact copy from mtxz's example
 */
function wc_get_template_part( $slug, $name = '', $third = null, $args = []) {
    $template = '';
    // Look in yourtheme/slug-name.php and yourtheme/woocommerce/slug-name.php
    if ( $name && ! WC_TEMPLATE_DEBUG_MODE ) {
        $template = locate_template( array( "{$slug}-{$name}.php", WC()->template_path() . "{$slug}-{$name}.php" ) );
    }
    // Get default slug-name.php
    if ( ! $template && $name && file_exists( WC()->plugin_path() . "/templates/{$slug}-{$name}.php" ) ) {
        $template = WC()->plugin_path() . "/templates/{$slug}-{$name}.php";
    }
    // If template file doesn't exist, look in yourtheme/slug.php and yourtheme/woocommerce/slug.php
    if ( ! $template && ! WC_TEMPLATE_DEBUG_MODE ) {
        $template = locate_template( array( "{$slug}.php", WC()->template_path() . "{$slug}.php" ) );
    }
    // Allow 3rd party plugins to filter template file from their plugin.
    $template = apply_filters( 'wc_get_template_part', $template, $slug, $name, $args );
    if ( $template ) {
        load_template( $template, false );
    }
}
/**
 * In mtxz's example he edit's woocommerce_content, I thought it wasn't necessary to include it
 * but I copied it aswell. Because in resources/views/woocommerce.blade.php we call to it.
 *
 * Still need to test if it is necessary.
 */
function woocommerce_content($args = [])
{
    if (is_singular('product')) {
        while (have_posts()) : the_post();
            wc_get_template_part('content', 'single-product', null, $args);
        endwhile;
    } else {  ?>

        <?php if (apply_filters('woocommerce_show_page_title', true)) : ?>
            <h1 class="page-title"><?php /*woocommerce_page_title(); */?></h1>

        <?php endif; ?>

        <?php do_action('woocommerce_archive_description'); ?>

        <?php if (have_posts()) : ?>

            <?php do_action('woocommerce_before_shop_loop'); ?>

            <?php woocommerce_product_loop_start(); ?>

            <?php woocommerce_product_subcategories(); ?>

            <?php while (have_posts()) : the_post(); ?>

                <?php wc_get_template_part('content', 'product', null, $args); ?>

            <?php endwhile; // end of the loop. ?>

            <?php woocommerce_product_loop_end(); ?>

            <?php do_action('woocommerce_after_shop_loop'); ?>

        <?php elseif (!woocommerce_product_subcategories(['before' => woocommerce_product_loop_start(false), 'after' => woocommerce_product_loop_end(false)])) : ?>

            <?php do_action('woocommerce_no_products_found'); ?>

        <?php endif;
    }
}

/**
 * This is almost a exact copy from the original Woocommerce plugin file,
 * the main difference is that I removed:
 *
 * if ( ! $defaulth_path ) {
 *  $default_path = WC()->plugin_path() . '/templates/';
 * }
 *
 * Because this makes the function look in the Woocommerce plugin templates directory, which is unwanted behaviour.
 *
 */
function wc_locate_template( $template_name, $template_path = '', $default_path = '' ) {
    if ( ! $template_path ) {
        $template_path = WC()->template_path();
    }
    if ( ! $default_path ) {
        $default_path = WC()->plugin_path() . '/templates/';
    }
    // Look within passed path within the theme - this is priority.
    $template = locate_template(
        array(
            trailingslashit( $template_path ) . $template_name,
            $template_name,
        )
    );
    // Get default template/
    if ( ! $template || WC_TEMPLATE_DEBUG_MODE ) {
        $template = $default_path . $template_name;
    }
    // Return what we found.
    return apply_filters( 'woocommerce_locate_template', $template, $template_name, $template_path );
}
/**
 * This remaind a exact copy from the wp-core-functions.php file.
 */
function wc_get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
    if ( ! empty( $args ) && is_array( $args ) ) {
        extract( $args );
    }
    $located = wc_locate_template( $template_name, $template_path, $default_path );
    if ( ! file_exists( $located ) ) {
        wc_doing_it_wrong( __FUNCTION__, sprintf( __( '%s does not exist.', 'woocommerce' ), '<code>' . $located . '</code>' ), '2.1' );
        return;
    }
    // Allow 3rd party plugin filter template file from their plugin.
    $located = apply_filters( 'wc_get_template', $located, $template_name, $args, $template_path, $default_path );
    do_action( 'woocommerce_before_template_part', $template_name, $template_path, $located, $args );
    include( $located );
    do_action( 'woocommerce_after_template_part', $template_name, $template_path, $located, $args );
}

//Hide WYSIWYG on frontpage tempalte
add_action( 'admin_head', function() {
	$template_file = basename(get_page_template());
  $page_title = get_the_title(get_the_ID());
	if($template_file == 'template-frontpage.blade.php' || $page_title == 'Shop' ||$template_file == 'template-team.blade.php' ){
		remove_post_type_support('page', 'editor');
    get_admin_page_title();
	}
});

//ACF options page
if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
    'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

//Construct Loop & Results
function store_filter(){
  $cat_id = $_GET['category'];
  echo $cat_id;
  //$posts_page = $_GET['post_page'];
  // include(locate_template('templates/archive-blog.php'));
  die();
}
