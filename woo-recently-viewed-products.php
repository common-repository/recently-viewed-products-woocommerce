<?php
/**
    * Plugin Name: Recently Viewed Products for Woocommerce
    * Plugin URI: https://wordpress.org/plugins/recently-viewed-products-woocommerce
    * Description: Recently Viewed Products for Woocommerce is a WooCommerce addon plugin. It allows you to show the recently viewed products of the users on the product detail page and anywhere else on the website by using the predefined shortcodes.
    * Version: 1.0.3
    * Author: Evincedev
    * Text Domain: woo-recently-viewed-products
    * License URI: https://www.gnu.org/licenses/gpl-3.0.html
    * Author URI: https://evincedev.com/
*/
// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
    echo 'Hi there!  I am just a plugin, not much I can do when called directly.';
    exit;
}
/* * ***************************************
  CHECK WORDPRESS WERSION
 * *************************************** */
if (version_compare(get_bloginfo('version'), '4.0', '<')) {
    $message = "WordPress version is lower than 4.0. Need WordPress version 4.0 or higher.";
    die($message);
}
/* * *******
  constants
 * ******** */
define('EVDPL_RVPS_PATH', plugin_dir_path(__FILE__));
define('EVDPL_RVPS_URI', plugin_dir_url(__FILE__));
/**
 * Check if WooCommerce is active
 * */
if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    if (!class_exists('EVDPL_RVPS_Core')) {
        class EVDPL_RVPS_Core {
            public function __construct() {
                /**
                 * Include Files
                 */
                require(EVDPL_RVPS_PATH . '/includes/activation.php');
                require(EVDPL_RVPS_PATH . '/views/admin/settings_page.php');
                require(EVDPL_RVPS_PATH . '/views/front-end/evdpl_rvps_products_view.php');
                require(EVDPL_RVPS_PATH . '/shortcodes/evdpl_rvps.php');
                /**
                 * Include Classes
                 */
                require(EVDPL_RVPS_PATH . 'classes/evdpl_rvps.php');
                require(EVDPL_RVPS_PATH . 'classes/evdpl_rvps_setting_page.php');
                require(EVDPL_RVPS_PATH . 'classes/evdpl_rvps_save_settings.php');
                require(EVDPL_RVPS_PATH . 'classes/evdpl_rvps_view.php');
                /**
                 * HOOKS 
                 */
                register_activation_hook(__FILE__, 'evdpl_rvps_activation');
                add_action('init', array(new Evdpl_rvps_session(), 'evdpl_rvps_start_session'), 10);
                add_action('init', array(new Evdpl_rvps_session(), 'evdpl_rvps_init_session'), 15);
                add_action('wp', array(new Evdpl_rvps_session(), 'evdpl_rvps_update_products'));
                add_action('admin_menu', array(new Evdpl_rvps_setting_page(), 'evdpl_rvps_create_setting_page'));
                add_action('admin_post_evdpl_rvps_save_settings_fields', array(new Evdpl_rvps_save_settings(), 'evdpl_rvps_save_admin_fields_settings'));
                add_action('woocommerce_after_single_product_summary', array(new Evdpl_rvps_view(), 'evdpl_rvps_show_before_related_products'), 19);
                add_action('woocommerce_after_single_product_summary', array(new Evdpl_rvps_view(), 'evdpl_rvps_show_after_related_products'), 21);
                add_action('woocommerce_cart_collaterals', array(new Evdpl_rvps_view(), 'evdpl_rvps_show_in_cart_page'), 20);
                add_action('woocommerce_after_shop_loop', array(new Evdpl_rvps_view(), 'evdpl_rvps_show_in_shop_page'), 15);
                add_action('wp_enqueue_scripts', 'custom_scripts_fun');
                function custom_scripts_fun() {
                    
                    wp_enqueue_script('rvps-custom-script', EVDPL_RVPS_URI . 'includes/custom-scripts.js', array('jquery'),'2.0',true);
                    wp_enqueue_script('rvps-slick-script', EVDPL_RVPS_URI . 'slick/slick.min.js', array('jquery'));
                    wp_enqueue_style('rvps-slick-css', EVDPL_RVPS_URI . 'slick/slick.css');
                    wp_enqueue_style('rvps-slick-css-theme', EVDPL_RVPS_URI . 'slick/slick-theme.css');
                    wp_enqueue_style('rvps-custom-style', EVDPL_RVPS_URI . 'assets/css/custom.css');
                }
                /**
                 * Add a link to the settings on the Plugins screen.
                 */
                function evdpl_rvps_settings_link( $links, $file ) {
                    if ( $file === 'woo-recently-viewed-products/woo-recently-viewed-products.php' && current_user_can( 'manage_options' ) ) {
                        if ( current_filter() === 'plugin_action_links' ) {
                            $url = esc_url( add_query_arg(
                                    'page',
                                    'evdpl_rvps_settings',
                                    get_admin_url() . 'admin.php'
                                ) );
                        } 
                        // Prevent warnings in PHP 7.0+ when a plugin uses this filter incorrectly.
                        $links = (array) $links;
                        $links[] = sprintf( '<a href="%s">%s</a>', $url, 'Settings' );
                    }
                    return $links;
                }
                add_filter( 'plugin_action_links', 'evdpl_rvps_settings_link', 10, 2 );
                add_shortcode('evdpl_rvps', 'evdpl_rvps_shortcode');
            }
        }
        $sour_init = new EVDPL_RVPS_Core();
    }
}else{
    die("Please install/activate WooCommerce & try again!!!");
}