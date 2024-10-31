<?php

/**
 * @package Woo Recently Viewed Products - Woocommerce
 * 
 */
/**
 * @param  integer $col_num      [Number of product column]
 * @param  integer $pruducts_num [Number of product]
 * @return products markup
 */
if (!function_exists('evdpl_rvps_products_view')) {

    function evdpl_rvps_products_view($col_num = 0, $pruducts_num = 0) {

        $products = new Evdpl_rvps_session();
        $products_ids = $products->evdpl_rvps_get_products();

        if (!$products_ids) {
            return false;
        }

        //if any product not found in recently viewed product array
        if (count($products_ids) <= 0) {
            return false;
        }

        $evdpl_rvps_settings = get_option('evdpl_rvps_settings');

        // if $pruducts_num(default) is zero the change its value to as per setting(evdpl_rvps_numb_products)
        if ($pruducts_num == 0) {
            $num_of_display_products = isset($evdpl_rvps_settings['evdpl_rvps_numb_products']) ? esc_attr($evdpl_rvps_settings['evdpl_rvps_numb_products']) : 4;
        } else {
            $num_of_display_products = $pruducts_num;
        }

        // getting last numbers of products from array as per settings(Number of recently viewed products)
        if (count($products_ids) > $num_of_display_products) {
            $ids = array_slice($products_ids, -1 * $num_of_display_products, $num_of_display_products, true);
        } else {
            $ids = $products_ids;
        }

        // Query products based on products in 
        $the_query = new WP_Query(array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'post__in' => array_reverse($ids),
            'orderby' => 'post__in'
        ));

        // Products Loop
        if ($the_query->have_posts()) {
            echo '<section class="products recent_products">';
            echo '<h2>' . ( isset($evdpl_rvps_settings['evdpl_rvps_label']) ? esc_attr($evdpl_rvps_settings['evdpl_rvps_label']) : '' ) . '</h2>';
            if ($col_num == 0) {
                $col = 4;
            } else {
                $col = 5;
            }

            echo '<div class="products evdpl-rvps " id="recently-viewed-slider">';
            while ($the_query->have_posts()) {
                $the_query->the_post();
                $products = get_post(get_the_ID());
                setup_postdata($GLOBALS['post'] = & $products);
                wc_get_template_part('content', 'product');
            }
            echo '</div>';
            echo '</section>';
            /* Restore Post Data */
            wp_reset_postdata();
        } else {
            return false;
        }
    }

}