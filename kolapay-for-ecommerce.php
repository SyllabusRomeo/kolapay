<?php
/**
 * Plugin Name: Kolapay Paymentv2 for WooCommerce
 * Plugin URI: https://kolapay.co.uk
 * Author Name: KolaTech
 * Author URI: https://kolapay.co.uk
 * Description: Local Mobile Payment Systems.
 * Version: 0.1.0
 * License: GPL2
 * License URL: http://www.gnu.org/licenses/gpl-2.0.txt
 * text-domain: kolapay-woo
 * 
 * Class WC_Gateway_Kolapay file.
 *
 * @package WooCommerce\Kolapay
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if(! in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) return;

function kola_payment_init(){
	if(class_exists('WC_Payment_Gateway')){
		require_once plugin_dir_path(__FILE__) .'/includes/class-wc-payment-gateway-kolapay.php';
		require_once plugin_dir_path(__FILE__) .'/includes/kolapay-order-statuses.php';
		require_once plugin_dir_path(__FILE__) .'/includes/kolapay-checkout-description-fields.php';
	}
}

add_action('plugins_loaded', 'kola_payment_init', 11);
add_filter('woocommerce_currencies', 'kolapay_add_ghs_currencies');
add_filter('woocommerce_currency_symbol', 'kolapay_add_ghs_currencies_symbol', 10, 2);
add_filter('woocommerce_payment_gateways', 'add_to_woo_kolapay_payment_gateway');

function add_to_woo_kolapay_payment_gateway($gateways){
    $gateways[] = 'WC_Gateway_Kolapay';
    return $gateways;
}

//Adding GHS ₵ Currency

function kolapay_add_ghs_currencies($currencies){
	$currencies['GHS'] = __('Ghanaian Cedis', 'kolapay-woo');
	return $currencies;
}

function kolapay_add_ghs_currencies_symbol($currency_symbol, $currency){
	switch($currency){
		case 'GHS':
			$currency_symbol = '₵';
		break;
	}
	return $currency_symbol;
}