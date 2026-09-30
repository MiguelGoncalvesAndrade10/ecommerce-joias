<?php
function register_my_menu() {
    register_nav_menu('header_menu', __('Header Menu'));
}

add_action('init', 'register_my_menu');

function my_theme_enqueue_styles() {
    wp_enqueue_style('my-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function ecommerce_joias_setup() {
    add_theme_support('title-tag');
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'ecommerce_joias_setup');

function ecommerce_product_security_message() {
    echo '<p class="product-security-message">
            Compra segura e envio para todo o Brasil.
          </p>';
}

add_action(
    'woocommerce_single_product_summary',
    'ecommerce_product_security_message',
    25
);
