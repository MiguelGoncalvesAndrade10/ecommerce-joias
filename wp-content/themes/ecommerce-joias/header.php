<?php
/**
 * Cabeçalho próprio do tema Ecommerce Joias.
 *
 * Mantém a navegação focada na descoberta de produtos e reúne busca, conta e
 * carrinho em uma estrutura compacta que permanece visível na rolagem.
 *
 * @package Ecommerce_Joias
 */

defined( 'ABSPATH' ) || exit;

$account_page_id = function_exists( 'wc_get_page_id' ) ? wc_get_page_id( 'myaccount' ) : 0;
$account_label   = get_theme_mod( 'ecommerce_joias_store_account_menu_label', 'Minha conta' );
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>

	<div id="page" class="site __os-page-wrap__">
		<a class="skip-link screen-reader-text" href="#content">
			<?php esc_html_e( 'Pular para o conteúdo', 'ecommerce-joias' ); ?>
		</a>

		<header class="nc-header" id="masthead"<?php if ( ecommerce_joias_has_header_hero() ) : ?> data-hero-overlay="true"<?php if ( ! is_front_page() ) : ?> style="--nc-header-hero-text:<?php echo esc_attr( sanitize_hex_color( get_theme_mod( 'ecommerce_joias_about_photo_text', '#ffffff' ) ) ?: '#ffffff' ); ?>"<?php endif; ?><?php endif; ?>>
			<div class="nc-header__row">
				<div class="nc-header__brand">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
							<?php bloginfo( 'name' ); ?>
						</a>
					<?php endif; ?>
				</div>

				<nav class="nc-header__navigation" aria-label="<?php esc_attr_e( 'Navegação principal', 'ecommerce-joias' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-1',
							'container'      => false,
							'menu_class'     => 'nc-header__menu',
							'fallback_cb'    => false,
						)
					);
					?>
				</nav>

				<div class="nc-header__utilities">
					<form class="nc-header__search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
						<label class="screen-reader-text" for="nc-header-search">
							<?php esc_html_e( 'Buscar produtos', 'ecommerce-joias' ); ?>
						</label>
						<input id="nc-header-search" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Buscar peças', 'ecommerce-joias' ); ?>">
						<input type="hidden" name="post_type" value="product">
						<button type="submit" aria-label="<?php esc_attr_e( 'Buscar', 'ecommerce-joias' ); ?>">
							<i class="bx bx-search" aria-hidden="true"></i>
						</button>
					</form>

					<div class="nc-header__actions">
					<?php if ( $account_page_id > 0 && get_theme_mod( 'ecommerce_joias_store_account_menu_enabled', true ) ) : ?>
						<a class="nc-header__action" href="<?php echo esc_url( get_permalink( $account_page_id ) ); ?>" aria-label="<?php echo esc_attr( $account_label ); ?>">
							<i class="bx bx-user" aria-hidden="true"></i>
							<span class="screen-reader-text"><?php echo esc_html( $account_label ); ?></span>
						</a>
					<?php endif; ?>

					<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<a class="nc-header__action nc-header__cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>" aria-label="<?php esc_attr_e( 'Carrinho', 'ecommerce-joias' ); ?>">
							<i class="bx bx-cart" aria-hidden="true"></i>
							<?php if ( WC()->cart && WC()->cart->get_cart_contents_count() > 0 ) : ?>
								<span class="nc-header__cart-count"><?php echo esc_html( WC()->cart->get_cart_contents_count() ); ?></span>
							<?php endif; ?>
							<span class="screen-reader-text"><?php esc_html_e( 'Carrinho', 'ecommerce-joias' ); ?></span>
						</a>
					<?php endif; ?>
					</div>
				</div>
			</div>
		</header>

		<div id="content" class="site-content">
