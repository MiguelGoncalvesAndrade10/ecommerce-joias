<?php
/**
 * Rodapé do tema Ecommerce Joias.
 *
 * @package Ecommerce_Joias
 */

$footer_description = get_theme_mod(
	'ecommerce_joias_footer_description',
	'Joias escolhidas para acompanhar momentos que merecem ser lembrados.'
);
$footer_email = get_theme_mod( 'ecommerce_joias_footer_email', '' );
$footer_instagram = get_theme_mod( 'ecommerce_joias_footer_instagram', '' );
$footer_copyright = get_theme_mod(
	'ecommerce_joias_footer_copyright',
	'Todos os direitos reservados.'
);
?>
	</div><!-- #content.site-content -->

	<footer class="nc-site-footer">
		<div class="nc-site-footer__main">
			<div class="nc-site-footer__brand">
				<?php if ( has_custom_logo() ) : ?>
					<?php the_custom_logo(); ?>
				<?php else : ?>
					<a class="nc-site-footer__brand-name" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php bloginfo( 'name' ); ?>
					</a>
				<?php endif; ?>

				<p><?php echo nl2br( esc_html( $footer_description ) ); ?></p>
			</div>

			<nav class="nc-site-footer__navigation" aria-label="<?php esc_attr_e( 'Navegação do rodapé', 'ecommerce-joias' ); ?>">
				<h2><?php esc_html_e( 'Navegue', 'ecommerce-joias' ); ?></h2>

				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'container'      => false,
						'menu_class'     => 'nc-site-footer__menu',
						'fallback_cb'    => false,
					)
				);
				?>
			</nav>

			<?php if ( $footer_email || $footer_instagram ) : ?>
				<div class="nc-site-footer__contact">
					<h2><?php esc_html_e( 'Atendimento', 'ecommerce-joias' ); ?></h2>

					<?php if ( $footer_email ) : ?>
						<a href="mailto:<?php echo esc_attr( $footer_email ); ?>">
							<?php echo esc_html( $footer_email ); ?>
						</a>
					<?php endif; ?>

					<?php if ( $footer_instagram ) : ?>
						<a href="<?php echo esc_url( $footer_instagram ); ?>" target="_blank" rel="noopener noreferrer">
							Instagram
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>

		<div class="nc-site-footer__bottom">
			<p>
				© <?php echo esc_html( wp_date( 'Y' ) ); ?>
				<?php bloginfo( 'name' ); ?>.
				<?php echo esc_html( $footer_copyright ); ?>
			</p>
		</div>
	</footer>

	<?php if ( function_exists( 'orchid_store_get_option' ) && orchid_store_get_option( 'display_scroll_top_button' ) ) : ?>
		<div class="orchid-backtotop">
			<span><i class="bx bx-chevron-up"></i></span>
		</div>
	<?php endif; ?>

</div><!-- #page.site -->

<?php wp_footer(); ?>

</body>
</html>
