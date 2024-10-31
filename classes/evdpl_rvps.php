<?php

/**
 * @package Woo Recently Viewed Products - Woocommerce
 */
if (!class_exists('Evdpl_rvps_session')) {

    class Evdpl_rvps_session {

        /**
         * evdpl_rvps_start_session 
         * USE: Start Session on initialization if its not started
         */
        public function evdpl_rvps_start_session() {
            if (!session_id()) {
                session_start();
            }
        }

        /**
         * [evdpl_rvps_session_name USE: Generate session name based on user ]
         * @return [string] [Generate session name based on user. For loggedin use session 
         * name would be 'evdpl_rvps_products_'.$user_id and 'evdpl_rvps_products_guest' 
         * for not loggedin user  ]
         */
        public function evdpl_rvps_session_name() {
            if (is_user_logged_in()) {
                $user_id = get_current_user_id();
                $evdpl_rvps_session_name = 'evdpl_rvps_products_' . $user_id;
            } else {
                $evdpl_rvps_session_name = 'evdpl_rvps_products_guest';
            }
            return $evdpl_rvps_session_name;
        }

        /**
         * [evdpl_rvps_init_session create session when user open site ]
         * @return [ empty array as session ] [create session based on user ]
         */
        public function evdpl_rvps_init_session() {
            if (!isset($_SESSION[$this->evdpl_rvps_session_name()])) {
                $_SESSION[$this->evdpl_rvps_session_name()] = serialize(array());
            }
        }

        /**
         * [evdpl_rvps_get_products get product ids array from session ]
         * @return [ products  array from session ] 
         */
        public function evdpl_rvps_get_products() {

            if (!isset($_SESSION[$this->evdpl_rvps_session_name()])) {
                return false;
            }

            return unserialize($_SESSION[$this->evdpl_rvps_session_name()]);
        }

        /**
         * [evdpl_rvps_update_products update session by current product id]
         *  Description: Update session by current product id.
         *  			if current product already exist in product array
         *  			then it will move current product to array's last element.
         */
        public function evdpl_rvps_update_products() {

            $products = $this->evdpl_rvps_get_products();

            // if not product page
            if (!is_product()) {
                return false;
            }


            //if current product not found in products array 
            if (!in_array(get_the_ID(), $products)) {
                $products[] = get_the_ID();
            } else {
                //if current product  found in products array 
                $cuurent_product_key = array_search(get_the_ID(), $products);
                unset($products[$cuurent_product_key]);
                $products[] = get_the_ID();
            }

            //update session
            $_SESSION[$this->evdpl_rvps_session_name()] = serialize($products);
        }

    }

}