<?php
/*
Plugin Name: AWM Repeat Buyer Discount
Plugin URI: https://www.aptwebmedia.com/repeat-buyer-discount/
Description: This plugin will allow store owners to provide discounts to repeat buyer. Supports Flat rate discount or Percentage discount with minimum purchase. 
Version: 0.0.1
Author: Albert Tagaban
Author URI: https://www.aptwebmedia.com
Text Domain: awm-repeat-buyer-discount-plugin
*/

require('inc/settings.php');


add_action('woocommerce_cart_calculate_fees' , 'awm_repeat_buyer_discount');

function awm_repeat_buyer_discount($cart) {
	global $woocommerce;

	$discounttype = get_option('awmrb_discounttype');
    $percentage = get_option('awmrb_discountpercentage');
    $flatrate =  get_option('awmrb_discountflatrate');
    $minorders =  get_option('awmrb_minorders');
	$discountlabel = get_option('awmrb_discountlabel');

	$current_user = wp_get_current_user();

	$args = array(
		'customer_id' => $current_user->ID,
		'status' => 'wc-completed',
		'return' => 'ids',
	);

	$orders_completed = count( wc_get_orders( $args ) );
	
	$cart_total = $cart->cart_contents_total; 

	if ($discounttype == 'percentage') {
		$discount = $cart_total * $percentage / 100;
		$discount_type = ' ('.$percentage.'% )';
	} else {
		$discount = $flatrate;
		$discount_type = '';
	}

	if ( $orders_completed > $minorders ) {
		$cart->add_fee( $discountlabel . $discount_type  , -$discount );
	}
}



	
