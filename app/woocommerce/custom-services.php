<?php
// app/woocommerce/custom-services.php

// Save custom total in cart item
add_filter('woocommerce_add_cart_item_data', 'save_custom_total_to_cart', 10, 3);
function save_custom_total_to_cart($cart_item_data, $product_id, $variation_id) {
    if (isset($_POST['custom_total_price'])) {
        $cart_item_data['custom_total_price'] = floatval($_POST['custom_total_price']);
    }
    return $cart_item_data;
}

// Display custom total on cart
add_filter('woocommerce_get_item_data', 'display_custom_total_on_cart', 10, 2);
function display_custom_total_on_cart($item_data, $cart_item) {
    if (isset($cart_item['custom_total_price'])) {
        $item_data[] = array(
            'name'  => 'Custom Total',
            'value' => wc_price($cart_item['custom_total_price']),
        );
    }
    return $item_data;
}

// Override price with custom totoa;
add_action('woocommerce_before_calculate_totals', 'override_price_with_custom_total', 10, 1);
function override_price_with_custom_total($cart) {
    if (is_admin() && !defined('DOING_AJAX')) return;

    foreach ($cart->get_cart() as $cart_item) {
        if (isset($cart_item['custom_total_price'])) {
            $cart_item['data']->set_price($cart_item['custom_total_price']);
        }
    }
}

// remove quantity counter 
add_action('after_setup_theme', function () {
  add_filter('woocommerce_cart_item_quantity', function ($product_quantity, $cart_item_key, $cart_item) {
    if (is_cart()) {
      return '<span class="fixed-quantity">1</span>';
    }
    return $product_quantity;
  }, 10, 3);
});
