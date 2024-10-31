<?php

/**
 * @package Woo Recently Viewed Products - Woocommerce
 * Use: Save plugin settings
 */
if (!class_exists('Evdpl_rvps_save_settings')) {

    class Evdpl_rvps_save_settings {

        /**
         *  USE: Save Plugin settings
         */
        public function evdpl_rvps_save_admin_fields_settings() {


            /*
             * 	Check current user capability for edit settings
             */
            if (!current_user_can('manage_options')) {
                wp_die('You are not allowed to edit this page.');
            }

            /*
             * 	Verify nonce field
             */
            check_admin_referer('evdpl_rvps_save_settings_fields_verify');

            $settings = array();

            /*
             * 	Save evdpl_rvps label
             */

            // if evdpl_rvps_label if empty 
            if (!isset($_POST['evdpl_rvps_label']) || sanitize_text_field($_POST['evdpl_rvps_label']) == '') {
                wp_redirect(get_admin_url() . 'admin.php?page=evdpl_rvps_settings&evdpl_rvps_save_error=' . urlencode('Add recently viewed products label'));
                exit();
            }

            $settings['evdpl_rvps_label'] = sanitize_text_field($_POST['evdpl_rvps_label']);

            /*
             * 	Save number of recently viewed products
             */
            //Check if evdpl_rvps_numb_products is empty
            if (!isset($_POST['evdpl_rvps_numb_products']) || sanitize_text_field($_POST['evdpl_rvps_numb_products']) == '') {
                wp_redirect(get_admin_url() . 'admin.php?page=evdpl_rvps_settings&evdpl_rvps_save_error=' . urlencode('Add number of  recently viewed products'));
                exit();
            }

            //check evdpl_rvps_numb_products value is numeric or not
            if (!is_numeric($_POST['evdpl_rvps_numb_products'])) {
                wp_redirect(get_admin_url() . 'admin.php?page=evdpl_rvps_settings&evdpl_rvps_save_error=' . urlencode('Put numeric value only on number of  recently viewed products'));
                exit();
            }

            //check if evdpl_rvps_numb_products value is negetive 
            if ($_POST['evdpl_rvps_numb_products'] <= 0) {
                wp_redirect(get_admin_url() . 'admin.php?page=evdpl_rvps_settings&evdpl_rvps_save_error=' . urlencode('Put positive numeric value only on number of  recently viewed products'));
                exit();
            }

            $settings['evdpl_rvps_numb_products'] = sanitize_text_field($_POST['evdpl_rvps_numb_products']);

            /*
             * 	Save evdpl_rvps position
             */
            //check if evdpl_rvps_position is empty
            if (!isset($_POST['evdpl_rvps_position']) || sanitize_text_field($_POST['evdpl_rvps_position']) == '') {
                wp_redirect(get_admin_url() . 'admin.php?page=evdpl_rvps_settings&evdpl_rvps_save_error=' . urlencode('Select value where recent products will show in product page'));
                exit();
            }

            // name sure evdpl_rvps_position value is before_related_product or after_related_product
            if (!in_array($_POST['evdpl_rvps_position'], array('before_related_product', 'after_related_product'))) {
                wp_redirect(get_admin_url() . 'admin.php?page=evdpl_rvps_settings&evdpl_rvps_save_error=' . urlencode('Invalid value of recently viewed products position.'));
                exit();
            }

            $settings['evdpl_rvps_position'] = sanitize_text_field($_POST['evdpl_rvps_position']);

            /*
             * 	Save evdpl_rvps show on shop page
             */
            // save evdpl_rvps_in_shop_page only when its value is enabled
            if (isset($_POST['evdpl_rvps_in_shop_page']) || sanitize_text_field($_POST['evdpl_rvps_in_shop_page']) === 'enabled') {
                $settings['evdpl_rvps_in_shop_page'] = sanitize_text_field($_POST['evdpl_rvps_in_shop_page']);
            }

            /*
             * 	Save evdpl_rvps show on cart page
             */
            // save evdpl_rvps_in_cart_page only when its value is enabled
            if (isset($_POST['evdpl_rvps_in_cart_page']) || sanitize_text_field($_POST['evdpl_rvps_in_cart_page']) === 'enabled') {
                $settings['evdpl_rvps_in_cart_page'] = sanitize_text_field($_POST['evdpl_rvps_in_cart_page']);
            }

            //update settings
            update_option('evdpl_rvps_settings', $settings);

            wp_redirect(get_admin_url() . 'admin.php?page=evdpl_rvps_settings&evdpl_rvps_success=' . urlencode('Field saved successfully.'));
            exit();
        }

    }

}