<?php
function register_my_menu()
{
    register_nav_menu('header_menu', __('Header Menu'));
}

add_action('init', 'register_my_menu');

function my_theme_enqueue_styles()
{
    wp_enqueue_style('my-theme-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

function ecommerce_joias_setup()
{
    add_theme_support('title-tag');
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'ecommerce_joias_setup');

/* =========================================================
   REMOVE SIDEBAR PADRÃO DO WOOCOMMERCE
========================================================= */

function ecommerce_joias_remove_woocommerce_sidebar() {
    remove_action(
        'woocommerce_sidebar',
        'woocommerce_get_sidebar',
        10
    );
}

add_action(
    'wp',
    'ecommerce_joias_remove_woocommerce_sidebar'
);


function ecommerce_product_security_message()
{
    echo '<p class="product-security-message">
            Compra segura e envio para todo o Brasil.
          </p>';
}

add_action(
    'woocommerce_single_product_summary',
    'ecommerce_product_security_message',
    25
);

function ecommerce_customize_register($wp_customize)
{

    $wp_customize->add_section('ecommerce_footer', array(
        'title' => 'Footer',
        'priority' => 120,
    ));

    $wp_customize->add_setting('footer_text', array(
        'default' => 'Ecommerce de Joias',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_text', array(
        'label' => 'Texto do Footer',
        'section' => 'ecommerce_footer',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_email', array(
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('footer_email', array(
        'label' => 'E-mail',
        'section' => 'ecommerce_footer',
        'type' => 'email',
    ));

    $wp_customize->add_setting('footer_whatsapp', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_whatsapp', array(
        'label' => 'WhatsApp',
        'section' => 'ecommerce_footer',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_instagram', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_instagram', array(
        'label' => 'Instagram',
        'section' => 'ecommerce_footer',
        'type' => 'text',
    ));

    $wp_customize->add_setting('footer_endereco', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('footer_endereco', array(
        'label' => 'Endereço',
        'section' => 'ecommerce_footer',
        'type' => 'text',
    ));
}

add_action('customize_register', 'ecommerce_customize_register');
