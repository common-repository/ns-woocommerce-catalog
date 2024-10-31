<?php
/*
Plugin Name: NS WooCommerce Catalog
Plugin URI: https://wordpress.org/plugins/ns-woocommerce-catalog/
Description: Switch their WooCommerce site in online catalog
Version: 2.4.2
Author: NsThemes
Author URI: http://nsthemes.com
Text Domain: ns-woocommerce-catalog
Domain Path: /languages
License: GNU General Public License v2.0
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


/** 
 * @author        PluginEye
 * @copyright     Copyright (c) 2019, PluginEye.
 * @version         1.0.0
 * @license       https://www.gnu.org/licenses/gpl-3.0.html GNU General Public License Version 3
 * PLUGINEYE SDK
*/

require_once('plugineye/plugineye-class.php');
$plugineye = array(
    'main_directory_name'       => 'ns-woocommerce-catalog',
    'main_file_name'            => 'ns-woocommerce-catalog.php',
    'redirect_after_confirm'    => 'admin.php?page=ns-woocommerce-catalog%2Fns-admin-options%2Fns_admin_option_dashboard.php',
    'plugin_id'                 => '210',
    'plugin_token'              => 'NWNmZTVlNmVjY2ZjMjUyZWQ4ZmJhNTAzZThhOWQ4ZTIzNTA0MWVmODY3Y2QzY2RjZDc0MjYxMjVhNWUzMjI4NTljMWMzZTgyNmM4NzY=',
    'plugin_dir_url'            => plugin_dir_url(__FILE__),
    'plugin_dir_path'           => plugin_dir_path(__FILE__)
);

$plugineyeobj210 = new pluginEye($plugineye);
$plugineyeobj210->pluginEyeStart();      
        

if ( ! defined( 'CATALOG_NS_PLUGIN_DIR' ) )
    define( 'CATALOG_NS_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

if ( ! defined( 'CATALOG_NS_PLUGIN_URL' ) )
    define( 'CATALOG_NS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/* *** include css admin *** */
function ns_wcatalog_css_admin( $hook ) {
	wp_enqueue_style('ns-catalog-style-admin', CATALOG_NS_PLUGIN_URL . '/css/style.css');
}
add_action( 'admin_enqueue_scripts', 'ns_wcatalog_css_admin' );

/* *** include css *** */
function ns_wcatalog_css( $hook ) {
	
	if (get_option('wcf_hide_cart_button_single_product') AND get_option('wcf_hide_cart_button_single_product') == 'on'	AND get_option('wcf_enabled_plugin') AND get_option('wcf_enabled_plugin') == 'on' ) {
		wp_enqueue_style('ns-catalog-style-single-product', CATALOG_NS_PLUGIN_URL . '/css/disabled-single-product.css');
	}
	if (get_option('wcf_hide_cart_button_all_product') AND get_option('wcf_hide_cart_button_all_product') == 'on' AND get_option('wcf_enabled_plugin') AND get_option('wcf_enabled_plugin') == 'on' ) {
		wp_enqueue_style('ns-catalog-style-all-product', CATALOG_NS_PLUGIN_URL . '/css/disabled-all-product.css');
	}
	if(get_option('wcf_show_more_info_button') == 'on'){
		wp_enqueue_style('ns-catalog-info', CATALOG_NS_PLUGIN_URL . '/css/ns-woo-catalog-info.css');
		wp_enqueue_style( 'all-min', CATALOG_NS_PLUGIN_URL . 'css/all.min.css', array(), '1.0.0' );
	}
}
add_action( 'wp_enqueue_scripts', 'ns_wcatalog_css' );

/* *** include js frontend *** */
function ns_wcatalog_js_fEnd( $hook ) {
	if(get_option('wcf_show_more_info_button') == 'on'){
		wp_enqueue_script('ns-woo-catalog-info.js', CATALOG_NS_PLUGIN_URL . '/js/ns-woo-catalog-info.js', array('jquery'));
		wp_localize_script( 'ns-woo-catalog-info.js', 'nssendrequest', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
		add_thickbox();
	}
}
add_action( 'wp_enqueue_scripts', 'ns_wcatalog_js_fEnd' );

/* *** include js *** */
function ns_wcatalog_js( $hook ) {
	wp_enqueue_script('ns-custom-script', CATALOG_NS_PLUGIN_URL . '/js/custom.js', array('jquery', 'wp-color-picker'));
}
add_action( 'admin_enqueue_scripts', 'ns_wcatalog_js' );

/* *** include single product catalog *** */
// require_once( CATALOG_NS_PLUGIN_DIR.'/woocommerce-catalog-single-product.php');

/* *** include admin option *** */
require_once( CATALOG_NS_PLUGIN_DIR.'/ns-woocommerce-catalog-admin.php');
/* *** include info page *** */
require_once( CATALOG_NS_PLUGIN_DIR.'/ns-woocommerce-catalog-info.php');

function ns_catalog_activate_set_default_options() {
    add_option('wcf_enabled_plugin', 'on');
    add_option('wcf_hide_cart_button_single_product', 'on');
    add_option('wcf_hide_cart_button_all_product', 'on');
    add_option('wcf_hide_cart_checkout_page', 'on');
}

/* *** include text domain *** */
function ns_woocommerce_catalog_load_plugin_textdomain() {
    load_plugin_textdomain( 'ns-woocommerce-catalog', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'ns_woocommerce_catalog_load_plugin_textdomain' );


/* *** plugin review trigger *** */
require_once( plugin_dir_path( __FILE__ ) .'/class/class-plugin-theme-review-request.php');

 
register_activation_hook( __FILE__, 'ns_catalog_activate_set_default_options');

function ns_wcatalog_remove_cart_checkout() {
	echo '
	<style>
	* {
		display: none !important;
	}
	</style>
	<script>
		window.location.href = "'.home_url().'";
	</script>';
	die();
}


if (get_option('wcf_hide_cart_checkout_page') AND get_option('wcf_hide_cart_checkout_page') == 'on' AND get_option('wcf_enabled_plugin') AND get_option('wcf_enabled_plugin') == 'on' ) {
	add_action( 'woocommerce_after_checkout_billing_form', 'ns_wcatalog_remove_cart_checkout' );
	add_action( 'woocommerce_before_cart', 'ns_wcatalog_remove_cart_checkout' );	

}

function ns_wcatalog_add_request_information() {
	
	echo '<input type="submit" name="RequestInfo" data-id-prodotto="'.get_the_ID().'" data-nome-prodotto="'.get_the_title( get_the_ID() ).'" value="'.__('More Info', 'ns-woocommerce-catalog').'" class="ns-woo-catalog-submit-for-info"><br><br>';
}
if (get_option('wcf_show_more_info_button') == 'on') {
	add_action( 'woocommerce_after_add_to_cart_form', 'ns_wcatalog_add_request_information', 5);
	add_action( 'woocommerce_after_shop_loop_item', 'ns_wcatalog_add_request_information' );	
}


add_action( 'wp_ajax_nopriv_ns_wc_send_request', 'ns_wc_send_request' );
add_action( 'wp_ajax_ns_wc_send_request', 'ns_wc_send_request' );
function ns_wc_send_request(){
	$ns_resp = '';
	// if(!isset($_POST['ns_mail_sender_name'])) 
	// 	$ns_resp = "error";
	if(!isset($_POST['ns_mail_sender_mail'])) 
		$ns_resp = "error";
	if(!isset($_POST['ns_mail_subject'])) 
		$ns_resp = "error";

	if($ns_resp == "error"){
		echo "error";
		die();
	}

    add_filter( 'wp_mail_from_name', function( $name ) {
        return $_POST['ns_mail_sender_name'];
    });
    
    add_filter( 'wp_mail_from', function( $email ) {
        return $_POST['ns_mail_sender_mail'];
    });

   
    //receiver
	$ns_send_to = get_option( 'admin_email' );

	//subject
	$ns_mail_subject = $_POST['ns_mail_subject']." (".get_the_title($_POST['ns_mail_product_name']).")";

	//body
	$ns_body_mail = "Hi, i need more information about this product.";
	if($_POST['ns_mail_body_content']!="") 
		$ns_body_mail = $_POST['ns_mail_body_content'];	
		
	
    $ns_response = "done";
	
	if(!wp_mail($ns_send_to, $ns_mail_subject, $ns_body_mail))
		$ns_response = "error";
    
	echo $ns_response;
	
    die();
}
 

/* *** *********************************************************************** *** */
/* ***     REMEMBER TO CHANGE FUNCTION NAME WITH THE PREFIX OF THIS PLUGIN     *** */
/* *** *********************************************************************** *** */
/* *** add menu page and add sub menu page *** */
function nswcat_preprocess_pages($value){
    global $pagenow;
    $page = (isset($_REQUEST['page']) ? $_REQUEST['page'] : false);
    if($pagenow=='admin.php' && $page=='how-to-install-premium-version'){
        wp_redirect('https://www.nsthemes.com/how-to-install-the-premium-version/');
        exit;
    }
}
add_action('admin_init', 'nswcat_preprocess_pages');


add_action( 'plugins_loaded', 'ns_catalog_free_load_textdomain' );

function ns_catalog_free_load_textdomain() {
  load_plugin_textdomain( 'ns-woocommerce-catalog', false, basename( dirname( __FILE__ ) ) . '/languages' ); 
}


/* *** add link premium *** */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'nswcatalog_add_action_links' );

function nswcatalog_add_action_links ( $links ) {	
 $mylinks = array('<a id="nscatlinkpremium" href="https://www.nsthemes.com/product/woocommerce-watermark/?ref-ns=2&campaign=linkpremium" target="_blank">'.__( 'Premium Version', 'ns-woocommerce-catalog' ).'</a>');
return array_merge( $links, $mylinks );
}
?>