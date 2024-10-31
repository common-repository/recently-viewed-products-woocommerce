<?php

/**
 * @package Woo Recently Viewed Products - Woocommerce
 * 
 */
/**
 * use to create wc recently viewed product shortcode
 */
if (!function_exists('evdpl_rvps_shortcode')) {

    function evdpl_rvps_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            'column' => 4,
            'products' => 4,
                        ), $atts, 'evdpl_rvps'));

        return evdpl_rvps_products_view($column, $products);
    }
}
