<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function ns_wcatalog_free_options_group() {
    register_setting('woocommerce_catalog_free_options', 'wcf_enabled_plugin');
    register_setting('woocommerce_catalog_free_options', 'wcf_hide_cart_button_single_product');
    register_setting('woocommerce_catalog_free_options', 'wcf_hide_cart_button_all_product');
    register_setting('woocommerce_catalog_free_options', 'wcf_hide_cart_checkout_page');
    register_setting('woocommerce_catalog_free_options', 'wcf_show_more_info_button');
}
 
add_action ('admin_init', 'ns_wcatalog_free_options_group');

$wt_repeat = get_option('wcf_enabled_plugin');
$wt_repeat = get_option('wcf_hide_cart_button_single_product');
$wt_repeat = get_option('wcf_hide_cart_button_all_product');
$wt_repeat = get_option('wcf_hide_cart_checkout_page');
$wt_repeat = get_option('wcf_show_more_info_button');

	// require_once("ns_admin_option_dashboard.php"); 
	
/* *** include admin option *** */
require_once( plugin_dir_path( __FILE__ ).'ns-admin-options/ns-admin-options-setup.php');
?>