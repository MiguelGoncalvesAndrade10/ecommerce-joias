<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<header class="site-header">

    <div class="announcement-bar">
        <div class="site-container announcement-content">
            <span>✦ Joias e semijoias selecionadas com carinho</span>
            <span>Envios para todo o Brasil</span>
        </div>
    </div>

    <div class="main-header">
        <div class="site-container main-header-content">

            <!-- Busca -->
            <div class="header-left">
                <a
                    href="<?php echo esc_url(home_url('/?s=')); ?>"
                    class="header-icon"
                    aria-label="Buscar"
                >
                    <svg viewBox="0 0 24 24">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="M16.5 16.5L21 21"></path>
                    </svg>
                </a>
            </div>

            <!-- Marca -->
            <div class="header-brand">

                <?php if (has_custom_logo()) : ?>

                    <?php the_custom_logo(); ?>

                <?php else : ?>

                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <span class="brand-monogram">NC</span>
                        <span class="brand-name">
                            <?php bloginfo('name'); ?>
                        </span>
                    </a>

                <?php endif; ?>

            </div>

            <!-- Conta / Carrinho -->
            <div class="header-actions">

                <?php if (class_exists('WooCommerce')) : ?>

                    <a
                        href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                        class="header-icon"
                        aria-label="Minha conta"
                    >
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="8" r="4"></circle>
                            <path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"></path>
                        </svg>
                    </a>

                    <a
                        href="<?php echo esc_url(wc_get_cart_url()); ?>"
                        class="header-icon cart-icon"
                        aria-label="Carrinho"
                    >
                        <svg viewBox="0 0 24 24">
                            <path d="M5 8h14l-1 12H6L5 8z"></path>
                            <path d="M9 9V6a3 3 0 0 1 6 0v3"></path>
                        </svg>

                        <?php if (WC()->cart) : ?>

                            <?php
                            $cart_count = WC()->cart->get_cart_contents_count();
                            ?>

                            <?php if ($cart_count > 0) : ?>
                                <span class="cart-count">
                                    <?php echo esc_html($cart_count); ?>
                                </span>
                            <?php endif; ?>

                        <?php endif; ?>

                    </a>

                <?php endif; ?>

            </div>

        </div>
    </div>

    <!-- Menu -->
    <nav class="main-navigation">
        <div class="site-container">

            <?php
            wp_nav_menu(array(
                'theme_location' => 'header_menu',
                'container'      => false,
                'menu_class'     => 'header-menu',
                'fallback_cb'    => false,
            ));
            ?>

        </div>
    </nav>

</header>