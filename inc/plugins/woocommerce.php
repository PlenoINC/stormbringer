<?php

// Remove Woocommerce styles
define('WOOCOMMERCE_USE_CSS',false); // until Woocommerce 2.1
add_filter( 'woocommerce_enqueue_styles', '__return_false' ); // after Woocommerce 2.1

// Replace Woocommerce button class with Bootstrap
add_filter('woocommerce_loop_add_to_cart_link', 'stormbringer_commerce_switch_buttons');
function stormbringer_commerce_switch_buttons( $button ){
	$button = str_replace('button', 'btn btn-default', $button);
	return $button;
}

// Place a cart icon with number of items and total cost in the menu bar.
function stormbringer_shoppingcart_menu() {

	global $woocommerce;
	$viewing_cart = __('View your shopping cart', 'stormbringer');
	$start_shopping = __('Start shopping', 'stormbringer');
	$cart_url = $woocommerce->cart->get_cart_url();
	$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
	$cart_contents_count = $woocommerce->cart->cart_contents_count;
	$cart_contents = sprintf(_n('%d item', '%d items', $cart_contents_count, 'stormbringer'), $cart_contents_count);
	$cart_total = $woocommerce->cart->get_cart_total();
	// Uncomment the line below to hide nav menu cart item when there are no items in the cart
	// if ( $cart_contents_count > 0 ) {
	if ($cart_contents_count == 0) {
		$menu_item = '<li><a class="woo-menu-cart" href="'. $shop_page_url .'" title="'. $start_shopping .'">';
	} else {
		$menu_item = '<li><a class="woo-menu-cart" href="'. $cart_url .'" title="'. $viewing_cart .'">';
	}
	$menu_item .= '<span class="glyphicon glyphicon-shopping-cart"></span> '.$cart_contents.' - '. $cart_total;
	$menu_item .= '</a></li>';

	echo $menu_item;

}
