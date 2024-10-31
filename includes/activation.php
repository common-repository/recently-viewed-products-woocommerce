<?php

/**
 * @package Woo Recently Viewed Products - Woocommerce
 * 
 */
if (!function_exists('evdpl_rvps_activation')) {

    /**
     * [evdpl_rvps_activation add setting option at the time of plugin activation]
     * 
     */
    function evdpl_rvps_activation() {
        //check if evdpl_rvps_settings option not found
        if (!get_option('evdpl_rvps_settings')) {

            add_option('evdpl_rvps_settings', array(
                'evdpl_rvps_label' => 'Recently Viewed Products',
                'evdpl_rvps_numb_products' => 4,
                'evdpl_rvps_position' => 'after_related_product',
                'evdpl_rvps_in_shop_page' => '',
                'evdpl_rvps_in_cart_page' => ''
            ));
        }
    }

}