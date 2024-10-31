<?php

/**
 * @package Woo Recently Viewed Products - Woocommerce
 */
if (!class_exists('Evdpl_rvps_setting_page')) {

    class Evdpl_rvps_setting_page {

        /**
         * Use: Add settings page under woocommerce
         */
        public function evdpl_rvps_create_setting_page() {
            add_submenu_page('woocommerce', __('Woo Recently Viewed Products', 'evdpl_rvps'), __('Woo Recently Viewed Products', 'evdpl_rvps'), 'manage_options', 'evdpl_rvps_settings', 'evdpl_rvps_setting_page_callback');
        }

    }

}