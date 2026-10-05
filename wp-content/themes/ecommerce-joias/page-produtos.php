<?php
/**
 * Página de descoberta de categorias de produto.
 *
 * @package Ecommerce_Joias
 */

get_header();

$categories = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => false,
		'parent'     => 0,
	)
);
?>

<main id="primary" class="site-main nc-products-page">
	<section class="nc-products-page__intro">
		<p class="nc-section-heading__eyebrow"><?php echo esc_html( get_theme_mod( 'ecommerce_joias_products_page_eyebrow', 'Explore a coleção' ) ); ?></p>
		<h1><?php echo esc_html( get_theme_mod( 'ecommerce_joias_products_page_title', 'Encontre a peça que combina com você' ) ); ?></h1>
		<p><?php echo esc_html( get_theme_mod( 'ecommerce_joias_products_page_description', 'Navegue pelas categorias e descubra peças para acompanhar cada momento.' ) ); ?></p>
	</section>

	<?php if ( ! is_wp_error( $categories ) && $categories ) : ?>
		<section class="nc-products-page__categories" aria-label="<?php esc_attr_e( 'Categorias de produtos', 'ecommerce-joias' ); ?>">
			<?php foreach ( $categories as $category ) : ?>
				<?php $image_id = absint( get_term_meta( $category->term_id, 'thumbnail_id', true ) ); ?>
				<a class="nc-category-card" href="<?php echo esc_url( get_term_link( $category ) ); ?>">
					<span class="nc-category-card__media">
						<?php if ( $image_id ) : ?>
							<?php echo wp_get_attachment_image( $image_id, 'medium_large', false, array( 'loading' => 'lazy' ) ); ?>
						<?php else : ?>
							<span aria-hidden="true">✦</span>
						<?php endif; ?>
					</span>
					<span class="nc-category-card__name"><?php echo esc_html( $category->name ); ?></span>
					<span class="nc-products-page__count"><?php echo esc_html( sprintf( _n( '%s produto', '%s produtos', $category->count, 'ecommerce-joias' ), number_format_i18n( $category->count ) ) ); ?></span>
				</a>
			<?php endforeach; ?>
		</section>
	<?php endif; ?>
</main>

<?php get_footer();
