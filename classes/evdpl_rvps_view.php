<?php

/**
 * @package Woo Recently Viewed Products - Woocommerce
 */
if (!class_exists('Evdpl_rvps_view')) {

    class Evdpl_rvps_view {

        /**
         * USE: Show recently Viewed products after related products on product page
         */
        public function evdpl_rvps_show_after_related_products() {
            $evdpl_rvps_settings = get_option('evdpl_rvps_settings');
            if (!isset($evdpl_rvps_settings['evdpl_rvps_position'])) {
                return;
            }
            //check  after_related_product option not selected
            if (esc_attr($evdpl_rvps_settings['evdpl_rvps_position']) !== 'after_related_product') {
                return;
            }

            if (evdpl_rvps_products_view()) {
                evdpl_rvps_products_view();
            }
        }

        /**
         * USE: Show recently Viewed products before related products on product page
         */
        public function evdpl_rvps_show_before_related_products() {

            $evdpl_rvps_settings = get_option('evdpl_rvps_settings');
            if (!isset($evdpl_rvps_settings['evdpl_rvps_position'])) {
                return;
            }

            //check  before_related_product option not selected
            if (esc_attr($evdpl_rvps_settings['evdpl_rvps_position']) !== 'before_related_product') {
                return;
            }

            if (evdpl_rvps_products_view()) {
                evdpl_rvps_products_view();
            }
        }

        /**
         * USE: Show recently Viewed products on cart page
         */
        public function evdpl_rvps_show_in_cart_page() {

            $evdpl_rvps_settings = get_option('evdpl_rvps_settings');
            if (!isset($evdpl_rvps_settings['evdpl_rvps_in_cart_page'])) {
                return;
            }

            //check if evdpl_rvps_in_cart_page option  checked
            if (esc_attr($evdpl_rvps_settings['evdpl_rvps_in_cart_page']) !== 'enabled') {
                return;
            }

            if (evdpl_rvps_products_view()) {
                evdpl_rvps_products_view();
            }
        }

        /**
         * USE: Show recently Viewed products on shop page
         */
        public function evdpl_rvps_show_in_shop_page() {

            $evdpl_rvps_settings = get_option('evdpl_rvps_settings');
            if (!isset($evdpl_rvps_settings['evdpl_rvps_in_shop_page'])) {
                return;
            }

            //check if evdpl_rvps_in_cart_page option  checked
            if (esc_attr($evdpl_rvps_settings['evdpl_rvps_in_shop_page']) !== 'enabled') {
                return;
            }

            if (evdpl_rvps_products_view()) {
                evdpl_rvps_products_view();
            }
        }

    }

}