<?php
/**
 * @package Woo Recently Viewed Products - Woocommerce
 * 
 */
/**
 * USE: To plugin Settings page Content
 */
if (!function_exists('evdpl_rvps_setting_page_callback')) {

    function evdpl_rvps_setting_page_callback() {
        ?>
        <div id="wpbody" role="main">

            <div id="wpbody-content" aria-label="Main content" tabindex="0">
                <div class="wrap">
                    <h1><?php _e('Woo Recently Viewed Products', 'evdpl_rvps'); ?></h1>
                    <?php
                    if (isset($_GET['evdpl_rvps_save_error'])) {
                        echo '<div style="background: #ff000061; padding: 11px 5px; border-radius: 6px; font-size: 15px;" class="sour_validation_msg">' . urldecode(sanitize_text_field($_GET['evdpl_rvps_save_error'])) . '</div>';
                    }
                    if (isset($_GET['evdpl_rvps_success'])) {
                        echo '<div style="background:#00800063; padding: 11px 5px; border-radius: 6px; font-size: 15px;" class="sour_validation_msg">' . urldecode(sanitize_text_field($_GET['evdpl_rvps_success'])) . '</div>';
                    }

                    $evdpl_rvps_settings = get_option('evdpl_rvps_settings');
                    ?>	
                    <table class="form-table">
                        <tbody>
                            <form method="post" action="admin-post.php">

                                <input type="hidden" name="action" value="evdpl_rvps_save_settings_fields" />

                                <?php wp_nonce_field('evdpl_rvps_save_settings_fields_verify'); ?>
                                <tr>
                                    <th scope="row">
                                        <label for="evdpl_rvps_label"><?php _e('Recently Viewed Products label', 'evdpl_rvps'); ?></label>
                                    </th>
                                    <td>
                                        <input name="evdpl_rvps_label" type="text" id="evdpl_rvps_label" value="<?php
                                        if (isset($evdpl_rvps_settings['evdpl_rvps_label'])) {
                                            echo esc_attr($evdpl_rvps_settings['evdpl_rvps_label']);
                                        }
                                        ?>" class="regular-text" required >
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label for="evdpl_rvps_numb_products"><?php _e('Number of recently viewed products', 'evdpl_rvps'); ?></label>
                                    </th>
                                    <td>
                                        <input name="evdpl_rvps_numb_products" type="number" id="evdpl_rvps_numb_products" value="<?php if (isset($evdpl_rvps_settings['evdpl_rvps_numb_products'])) { echo esc_attr($evdpl_rvps_settings['evdpl_rvps_numb_products']); } ?>"  required >
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="row">
                                        <label for="evdpl_rvps_position"><?php _e('Recently viewed products position in product page', 'evdpl_rvps'); ?></label>
                                    </th>
                                    <td>
                                        <input <?php if (isset($evdpl_rvps_settings['evdpl_rvps_position'])) { if (esc_attr($evdpl_rvps_settings['evdpl_rvps_position']) == 'before_related_product') { echo 'checked'; }  } ?> name="evdpl_rvps_position" type="radio" id="evdpl_rvps_position" value="before_related_product" >
                                        <span style="padding-right:20px;" ><?php _e('Before Related Product', ''); ?></span>

                                        <input <?php if (isset($evdpl_rvps_settings['evdpl_rvps_position'])) { if (esc_attr($evdpl_rvps_settings['evdpl_rvps_position']) == 'after_related_product') { echo 'checked'; } } ?>  name="evdpl_rvps_position" type="radio" id="evdpl_rvps_position" value="after_related_product" >
                                        <span><?php _e('After Related Product', ''); ?></span>

                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        <label for="evdpl_rvps_in_shop_page"><?php _e('Show Recently viewed products in shop page', 'evdpl_rvps'); ?></label>
                                    </th>
                                    <td>
                                        <input <?php
                                    if (isset($evdpl_rvps_settings['evdpl_rvps_in_shop_page'])) {
                                        if (esc_attr($evdpl_rvps_settings['evdpl_rvps_in_shop_page']) == 'enabled') {
                                            echo 'checked';
                                        }
                                    }
                                    ?> name="evdpl_rvps_in_shop_page" type="checkbox" id="evdpl_rvps_in_shop_page" value="enabled" > <span><?php _e('Show', 'evdpl_rvps'); ?></span>
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">
                                        <label for="evdpl_rvps_in_cart_page"><?php _e('Show Recently viewed products in cart page', 'evdpl_rvps'); ?></label>
                                    </th>
                                    <td>
                                        <input <?php if (isset($evdpl_rvps_settings['evdpl_rvps_in_cart_page'])) { if (esc_attr($evdpl_rvps_settings['evdpl_rvps_in_cart_page']) == 'enabled') { echo 'checked'; }  } ?> name="evdpl_rvps_in_cart_page" type="checkbox" id="evdpl_rvps_in_cart_page" value="enabled" > <span><?php _e('Show', 'evdpl_rvps'); ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <button name="save" class="button-primary" type="submit" value="<?php _e('Save Changes', 'evdpl_rvps'); ?>">Save changes</button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php
    }

}