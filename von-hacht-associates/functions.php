<?php
/**
 * Genesis Sample.
 *
 * This file adds functions to the Genesis Sample Theme.
 *
 * @package Genesis Sample
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://www.studiopress.com/
 */

// Start the engine.
//include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once(get_stylesheet_directory() . '/lib/theme-defaults.php');

// Set Localization (do not remove).
add_action('after_setup_theme', 'genesis_sample_localization_setup');
function genesis_sample_localization_setup()
{
    load_child_theme_textdomain('genesis-sample', get_stylesheet_directory() . '/languages');
}

// Add the helper functions.
include_once(get_stylesheet_directory() . '/lib/helper-functions.php');

// Add Image upload and Color select to WordPress Theme Customizer.
require_once(get_stylesheet_directory() . '/lib/customize.php');

// Add Image SVG support.
require_once(get_stylesheet_directory() . '/lib/svg-support.php');

// Include Customizer CSS.
include_once(get_stylesheet_directory() . '/lib/output.php');

// Add WooCommerce support.
include_once(get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php');

// Add the required WooCommerce styles and Customizer CSS.
include_once(get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php');

// Add the Genesis Connect WooCommerce notice.
include_once(get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php');

// Child theme (do not remove).
define('CHILD_THEME_NAME', 'Genesis Sample');
define('CHILD_THEME_URL', 'http://www.studiopress.com/');
define('CHILD_THEME_VERSION', '2.3.0');

// Enqueue Scripts and Styles.
add_action('wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles');
function genesis_sample_enqueue_scripts_styles()
{

    //wp_enqueue_style('genesis-sample-fonts', 'https://use.typekit.net/meq7dmc.css', array(), CHILD_THEME_VERSION);
    wp_enqueue_style('genesis-custom-style-found', get_stylesheet_directory_uri() . '/css/css/foundation.css', array());
    wp_enqueue_style('genesis-custom-style', get_stylesheet_directory_uri() . '/css/css/custom.css', array());
    wp_enqueue_style('dashicons');


    $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';

    wp_enqueue_script('jarallax', get_stylesheet_directory_uri() . '/js/plugins/jarallax.min.js', null, '1.12.0', true);
    wp_enqueue_script('jarallax_element', get_stylesheet_directory_uri() . '/js/plugins/jarallax-element.esm.js', null, '1.12.0', true);


    wp_enqueue_script('custom', get_stylesheet_directory_uri() . "/js/custom.js", array('jquery'), CHILD_THEME_VERSION, true);

    wp_enqueue_script('genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array('jquery'), CHILD_THEME_VERSION, true);
    wp_localize_script(
        'genesis-sample-responsive-menu',
        'genesis_responsive_menu',
        genesis_sample_responsive_menu_settings()
    );

}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings()
{

    $settings = array(
        'mainMenu' => __('Menu', 'genesis-sample'),
        'menuIconClass' => 'dashicons-before dashicons-menu',
        'subMenu' => __('Submenu', 'genesis-sample'),
        'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
        'menuClasses' => array(
            'combine' => array(
                '.nav-primary',
                '.nav-header',
            ),
            'others' => array(),
        ),
    );

    return $settings;

}

// Add HTML5 markup structure.
add_theme_support('html5', array('caption', 'comment-form', 'comment-list', 'gallery', 'search-form'));

// Add Accessibility support.
add_theme_support('genesis-accessibility', array('404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links'));

// Add viewport meta tag for mobile browsers.
add_theme_support('genesis-responsive-viewport');

// Add support for custom header.
add_theme_support('custom-header', array(
    'width' => 600,
    'height' => 160,
    'header-selector' => '.site-title a',
    'header-text' => false,
    'flex-height' => true,
));

// Add support for custom background.
add_theme_support('custom-background');

// Add support for after entry widget.
add_theme_support('genesis-after-entry-widget-area');

// Add support for 3-column footer widgets.
add_theme_support('genesis-footer-widgets', 3);

// Add Image Sizes.
add_image_size('featured-image', 720, 400, TRUE);

// Rename primary and secondary navigation menus.
add_theme_support('genesis-menus', array('primary' => __('After Header Menu', 'genesis-sample'), 'secondary' => __('Footer Menu', 'genesis-sample')));

// Reposition the secondary navigation menu.
remove_action('genesis_after_header', 'genesis_do_subnav');
add_action('genesis_footer', 'genesis_do_subnav', 5);

// Reduce the secondary navigation menu to one level depth.
add_filter('wp_nav_menu_args', 'genesis_sample_secondary_menu_args');
function genesis_sample_secondary_menu_args($args)
{

    if ('secondary' != $args['theme_location']) {
        return $args;
    }

    $args['depth'] = 1;

    return $args;

}

// Modify size of the Gravatar in the author box.
add_filter('genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar');
function genesis_sample_author_box_gravatar($size)
{
    return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter('genesis_comment_list_args', 'genesis_sample_comments_gravatar');
function genesis_sample_comments_gravatar($args)
{

    $args['avatar_size'] = 60;

    return $args;

}

// BEGIN FOOTER
remove_action('genesis_footer', 'genesis_footer_markup_open', 5);
remove_action('genesis_footer', 'genesis_do_footer');
remove_action('genesis_footer', 'genesis_footer_markup_close', 15);
function wpb_footer_creds_text()
{
    $copyright = '';
    return $copyright;
}

add_filter('genesis_footer_creds_text', 'wpb_footer_creds_text');

// Customize site footer
add_action('genesis_footer', 'sp_custom_footer');

function sp_custom_footer()
{ ?>

    <div class="site-footer__inner">

        <?php if (is_page_template('templates/template-home.php') || is_page_template("templates/custom-page.php")): ?>
            <div class="grid-container">
                <div class="grid-x grid-margin-x">

                    <?php if ($form = get_field('form_home_page', 'option')): ?>
                        <div class="cell large-5  medium-6  medium-order-2 footer__form-container">
                            <div class="footer__form">
                                <?php echo $form ?>
                            </div>

                        </div>
                    <?php endif; ?>

                    <div class="cell large-5 medium-6 large-offset-1 medium-order-1 text-left footer__content-container">
                        <?php if ($footer_logo = get_field('logo_text', 'option')): ?>
                            <div class="footer__logo">
                                <h2><?php echo $footer_logo ?></h2></div>
                        <?php endif; ?>
                        <?php if (get_field('address_link', 'option') || get_field('address_text', 'option')):
                            $text = get_field('address_text', 'option') ? get_field('address_text', 'option') : 'Address'; ?>
                            <a href="<?php echo get_field('address_link', 'option') ?>" target="_blank" class="footer__address"><?php echo $text ?></a>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3738.827716624816!2d-112.041907!3d43.490312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x535459459952dfe9%3A0x79ec5ab9326479ad!2sCutler%20Law%20Office%2C%20P.A.!5e1!3m2!1sen!2sus!4v1761074765304!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

                        <?php endif; ?>

                        <?php if (have_rows('social_icons', 'option')) : ?>
                            <ul class="socials">
                                <?php while (have_rows('social_icons', 'option')) : the_row(); ?>
                                    <?php
                                    $social_icon = get_sub_field('social_icon');
                                    $social_link = get_sub_field('social_link');
                                    ?>
                                    <li>
                                        <a class="social-icon" href="<?php echo $social_link; ?>" target="_blank">
                                            <img src="<?php echo $social_icon['url']; ?>"
                                                 alt="<?php echo $social_icon['alt']; ?>">
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if (get_field('copyright', 'option')): ?>
                            <div class="copyright">
                                <?php the_field('copyright', 'option') ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>

            <?php if ($footer_logo = get_field('logo_text', 'option')): ?>
                <div class="footer__single-page-logo">
                    <div class="grid-container">
                        <div class="grid-x grid-margin-x">
                            <div class="cell text-left">
                                <a href="<?php echo get_home_url() ?>" class="footer__logo">
                                    <h2><?php echo $footer_logo ?></h2></a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="grid-container footer__single-page-content">
                <div class="grid-x grid-padding-x align-middle">

                    <?php if (get_field('address_link', 'option') || get_field('address_text', 'option')):
                        $text = get_field('address_text', 'option') ? get_field('address_text', 'option') : 'Address'; ?>
                        <div class="cell large-4 medium-12  text-left footer__single-page-address">
                            <a href="<?php echo get_field('address_link', 'option') ?>" target="_blank" class="footer__address"><?php echo $text ?></a>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3738.827716624816!2d-112.041907!3d43.490312!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x535459459952dfe9%3A0x79ec5ab9326479ad!2sCutler%20Law%20Office%2C%20P.A.!5e1!3m2!1sen!2sus!4v1761074765304!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    <?php endif; ?>

                    <?php if (have_rows('social_icons', 'option')) : ?>
                        <div class="cell large-4 medium-12  text-center footer__single-page-socials">
                            <ul class="socials">
                                <?php while (have_rows('social_icons', 'option')) : the_row(); ?>
                                    <?php
                                    $social_icon = get_sub_field('social_icon');
                                    $social_link = get_sub_field('social_link');
                                    ?>
                                    <li>
                                        <a class="social-icon" href="<?php echo $social_link; ?>" target="_blank">
                                            <img src="<?php echo $social_icon['url']; ?>"
                                                 alt="<?php echo $social_icon['alt']; ?>">
                                        </a>
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if (get_field('copyright', 'option')): ?>
                        <div class="cell large-4 medium-12  text-left footer__single-page-copyright">
                            <div class="copyright copyright--single-page">
                                <?php the_field('copyright', 'option') ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>

        <?php endif; ?>


    </div>

    <?php }

// END FOOTER


/**
 * Custom styles in TinyMCE
 *
 * @param array $buttons
 *
 * @return array
 */

function custom_style_selector($buttons)
{
    array_unshift($buttons, 'styleselect');

    return $buttons;
}

add_filter('mce_buttons_2', 'custom_style_selector');

function insert_custom_formats($init_array)
{
    // Define the style_formats array
    $style_formats = array(
        array(
            'title' => 'Heading 1',
            'classes' => 'h1',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Heading 2',
            'classes' => 'h2',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Heading 3',
            'classes' => 'h3',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Heading 4',
            'classes' => 'h4',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Heading 5',
            'classes' => 'h5',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Heading 6',
            'classes' => 'h6',
            'selector' => 'h1,h2,h3,h4,h5,h6,p,li',
            'wrapper' => false,
        ),
        array(
            'title' => 'Button',
            'classes' => 'button',
            'selector' => 'a',
            'wrapper' => false,
        ),


    );
    $init_array['style_formats'] = json_encode($style_formats);

    return $init_array;

}

add_filter('tiny_mce_before_init', 'insert_custom_formats');

add_editor_style();

// Disable gutenberg
add_filter('use_block_editor_for_post_type', '__return_false', 10);


if (function_exists('acf_add_options_page')) {

    acf_add_options_page('Theme Settings');

    acf_add_options_page(array(
        'page_title'    => 'Global Schema',
        'menu_title'    => 'Global Schema',
        'menu_slug'     => 'global-schema',
        'capability'    => 'edit_posts',
        'icon_url'      => 'dashicons-networking', // Add this line and replace the second inverted commas with class of the icon you like
        'redirect'      => false
    ));

}

function themeprefix_search_button_text($text)
{
    return ('');
}

add_filter('genesis_search_text', 'themeprefix_search_button_text');


add_filter('genesis_pre_get_option_content_archive_limit', 'hs_content_limit');
function hs_content_limit()
{
    return '150'; // number of characters
}

// Custom Logo
add_theme_support('custom-logo', array(
    'height' => '150',
    'flex-height' => true,
    'flex-width' => true,
));

function show_custom_logo($size = 'medium')
{
    if ($custom_logo_id = get_theme_mod('custom_logo')) {
        $attachment_array = wp_get_attachment_image_src($custom_logo_id, $size);
        $logo_url = $attachment_array[0];
    } else {
        $logo_url = get_stylesheet_directory_uri() . '/images/custom-logo.png';
    }
    $logo_image = '<img src="' . $logo_url . '" class="custom-logo" itemprop="siteLogo" alt="' . get_bloginfo('name') . '">';
    $html = sprintf('<a href="%1$s" class="custom-logo-link" rel="home" title="%2$s" itemscope>%3$s</a>', esc_url(home_url('/')), get_bloginfo('name'), $logo_image);
    echo apply_filters('get_custom_logo', $html);
}

function my_login_logo_one()
{
    if ($custom_logo_id = get_theme_mod('custom_logo')) {
        $attachment_array = wp_get_attachment_image_src($custom_logo_id, $size);
        $logo_url = $attachment_array[0];
    } else {
        $logo_url = get_stylesheet_directory_uri() . '/images/custom-logo.png';
    }
    ?>

    <style type="text/css">
        body.login div#login h1 a {
            background-image: url(<?php echo $logo_url?>);
            padding-bottom: 30px;
            background-size: contain;
            width: 300px;

        }
    </style>
    <?php
}

add_action('login_enqueue_scripts', 'my_login_logo_one');

// add excerpts search page result
add_action( 'genesis_before_loop', 'sk_excerpts_search_page' );
function sk_excerpts_search_page() {
  if ( is_search() ) {
		add_filter( 'genesis_pre_get_option_content_archive', 'sk_show_excerpts' );
	}
}

function sk_show_excerpts() {
	return 'excerpt';
}

add_action('plugins_loaded','ao_defer_inline_init');
function ao_defer_inline_init() {
	if ( get_option('autoptimize_js_include_inline') != 'on' ) {
		add_filter('autoptimize_html_after_minify','ao_defer_inline_jquery',10,1);
	}
}
function ao_defer_inline_jquery( $in ) {
  if ( preg_match_all( '#<script.*>(.*)</script>#Usmi', $in, $matches, PREG_SET_ORDER ) ) {
    foreach( $matches as $match ) {
      if ( $match[1] !== '' && ( strpos( $match[1], 'jQuery' ) !== false || strpos( $match[1], '$' ) !== false ) ) {
        // inline js that requires jquery, wrap deferring JS around it to defer it.
        $new_match = 'var aoDeferInlineJQuery=function(){'.$match[1].'}; if (document.readyState === "loading") {document.addEventListener("DOMContentLoaded", aoDeferInlineJQuery);} else {aoDeferInlineJQuery();}';
        $in = str_replace( $match[1], $new_match, $in );
      } else if ( $match[1] === '' && strpos( $match[0], 'src=' ) !== false && strpos( $match[0], 'defer' ) === false ) {
        // linked non-aggregated JS, defer it.
        $new_match = str_replace( '<script ', '<script defer ', $match[0] );
        $in = str_replace( $match[0], $new_match, $in );
      }
    }
  }
  return $in;
}

function year_shortcode() {
	$year = date('Y');
	return $year;
}
add_shortcode('year', 'year_shortcode');

//* Modify the Genesis content limit read more link
add_filter( 'get_the_content_more_link', 'sp_read_more_link' );
function sp_read_more_link() {
	return '... <a class="more-link button" href="' . get_permalink() . '">Read More</a>';
}

add_shortcode('gngf-logo', 'gngf_logo_function');
function gngf_logo_function() {
     return '<a class="gngf-link" style="display: block;" href="https://gngf.com" target="_blank" rel="nofollow noopener noreferrer"><svg fill="#ffffff" version="1.1" id="GNGF-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="19px" x="0px" y="0px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve"><g><polygon points="7.7,4.3 0,4.3 0,19 14.8,19 14.8,11.3 7.7,11.3"></polygon><polygon points="19,0 7.7,0 7.7,4.3 14.8,4.3 14.8,11.3 19,11.3"></polygon></g></svg></a>';
}

function gngf_filter_posts_scripts() {

    wp_localize_script( 'custom', 'gngf_vars', array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
        )
    );
}

add_action( 'wp_enqueue_scripts', 'gngf_filter_posts_scripts', 100 );
function gngf_filter_get_posts( $taxonomy ) {

	$category = $_POST['category'];
	$paged    = $_POST['paged'];
	$paged    = ! empty( $paged ) ? (int) $paged : 1;
	$category = ! empty( $category ) && $category != '-1' ? array(
		'taxonomy' => 'faqs_category',                //(string) - Taxonomy.
		'field'    => 'slug',                    //(string) - Select taxonomy term by ('id' or 'slug')
		'terms'    => $category,    //(int/string/array) - Taxonomy term(s).
	) : '';

	$args = array(
		'post_type'      => 'faq',
		'post_status'    => 'publish',
		'tax_query'      => array(
			$category,
		),
		'posts_per_page' => get_option( 'posts_per_page' ),
		'paged'          => $paged,
	);
	if ( ! $taxonomy ) {
		unset( $args['tag'] );
	}
	$wp_query = new WP_Query( $args );
	if ( $wp_query->have_posts() ) : ?>
		<?php while ( $wp_query->have_posts() ) : $wp_query->the_post();
			get_template_part( 'parts/faqs/faq-item' );
		endwhile; ?>
		<?php
		$paginateArgs = array(
			'base'      => '%#%',
			'format'    => '%#%',
			'current'   => $paged,
			'prev_next' => false,
			'total'     => $wp_query->max_num_pages
		); ?>
		<div class="cn-pagination">
			<?php echo str_replace(array('http:', '//'), array('', '') ,paginate_links( $paginateArgs )); ?>
		</div>
	<?php else: ?>
		<h2><?php _e( 'No posts found', 'default' ); ?></h2>
	<?php endif;

	wp_die();
}

add_action( 'wp_ajax_filter_posts', 'gngf_filter_get_posts' );
add_action( 'wp_ajax_nopriv_filter_posts', 'gngf_filter_get_posts' );

/** CSS Cache Buster */
//remove style.css version
add_filter( 'style_loader_src',  'sdt_remove_ver_css_js', 9999, 2 );
add_filter( 'script_loader_src', 'sdt_remove_ver_css_js', 9999, 2 );

function sdt_remove_ver_css_js( $src, $handle )
{
	$handles_with_version = [ 'genesis-sample' ]; // <-- Adjust to your needs!

	if ( strpos( $src, 'ver=' ) && ! in_array( $handle, $handles_with_version, true ) )
		$src = remove_query_arg( 'ver', $src );

	return $src;
}


define( 'CHILD_THEME_VERSION', filemtime( get_stylesheet_directory() . '/style.css' ) );

add_filter( 'stylesheet_uri', 'child_stylesheet_uri' );
/**
 * Cache bust the style.css reference.
 *
 */
function child_stylesheet_uri( $stylesheet_uri ) {
	return add_query_arg( 'v', filemtime( get_stylesheet_directory() . '/style.css' ), $stylesheet_uri );
}


//Breadcrumbs
add_filter( 'wpseo_breadcrumb_links', 'wpseo_breadcrumb_remove_limited' );

function wpseo_breadcrumb_remove_limited( $links ) {
    if (  is_singular ( 'testimonial' ) ) {
        $breadcrumb[] = array(
            'url' => site_url( '/testimonials/' ),
            'text' => 'Testimonials',
        );
        array_splice( $links, 1, -1, $breadcrumb );
    }
    if (  is_singular ( 'team' ) ) {
        $breadcrumb[] = array(
            'url' => site_url( '/attorneys/' ),
            'text' => 'Attorneys',
        );
        array_splice( $links, 1, -1, $breadcrumb );
    }
    if (  is_singular ( 'faq' ) ) {
        $breadcrumb[] = array(
            'url' => site_url( '/faqs/' ),
            'text' => 'FAQs',
        );
        array_splice( $links, 1, -1, $breadcrumb );
    }
    if (  is_singular ( 'staff' ) ) {
        $breadcrumb[] = array(
            'url' => site_url( '/staff/' ),
            'text' => 'Staff',
        );
        array_splice( $links, 1, -1, $breadcrumb );
    }
    return $links;

    function retrieve_latest_gform_submissions() {
    $site_url = get_site_url();
    $search_criteria = [
        'status' => 'active'
    ];
    $form_ids = 1; //search all forms
    $sorting = [
        'key' => 'date_created',
        'direction' => 'DESC'
    ];
    $paging = [
        'offset' => 0,
        'page_size' => 5
    ];
    
    $submissions = GFAPI::get_entries($form_ids, null, $sorting, $paging);
    $start_date = date('Y-m-d H:i:s', strtotime('-5 day'));
    $end_date = date('Y-m-d H:i:s');
    $entry_in_last_5_days = false;
    
    foreach ($submissions as $submission) {
        if( $submission['date_created'] > $start_date  && $submission['date_created'] <= $end_date ) {
            $entry_in_last_5_days = true;
        } 
    }
    if( !$entry_in_last_5_days ) {
        wp_mail('webdev@postali.com', 'Submission Status', "No submissions in last 5 days on $site_url");
    }
}
add_action('check_form_entries', 'retrieve_latest_gform_submissions');

/**
 * Disable Theme/Plugin File Editors in WP Admin
 * - Hides the submenu items
 * - Blocks direct access to editor screens
 */
function postali_disable_file_editors_menu() {
    // Remove Theme File Editor from Appearance menu
    remove_submenu_page( 'themes.php', 'theme-editor.php' );
    // Optional: also remove Plugin File Editor from Plugins menu
    remove_submenu_page( 'plugins.php', 'plugin-editor.php' );
}
add_action( 'admin_menu', 'postali_disable_file_editors_menu', 999 );

// Block direct access to the editors even if someone knows the URL
function postali_block_file_editors_direct_access() {
    wp_die( __( 'File editing through the WordPress admin is disabled.' ), 403 );
}
add_action( 'load-theme-editor.php', 'postali_block_file_editors_direct_access' );
add_action( 'load-plugin-editor.php', 'postali_block_file_editors_direct_access' );

/**
 * Disable the Additional CSS panel in the Customizer.
 * Primary method: remove the custom_css component early in load.
 */
function postali_disable_customizer_additional_css_component( $components ) {
    $key = array_search( 'custom_css', $components, true );
    if ( false !== $key ) {
        unset( $components[ $key ] );
    }
    return $components;
}
add_filter( 'customize_loaded_components', 'postali_disable_customizer_additional_css_component' );

/**
 * Fallback: remove the Additional CSS section if it's present.
 */
function postali_remove_customizer_additional_css_section( $wp_customize ) {
    if ( method_exists( $wp_customize, 'remove_section' ) ) {
        $wp_customize->remove_section( 'custom_css' );
    }
}
add_action( 'customize_register', 'postali_remove_customizer_additional_css_section', 20 );
}