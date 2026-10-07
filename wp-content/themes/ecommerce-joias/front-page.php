<?php
/**
 * Página inicial da NC Semijoias.
 *
 * @package Ecommerce_Joias
 */

/**
 * Busca informações do tema Ecommerce Joias para exibição na página inicial.
 */
$hero_image_id = absint( get_theme_mod( 'ecommerce_joias_hero_image', 0 ) );
$hero_image    = '';
$brand_story_enabled  = (bool) get_theme_mod( 'ecommerce_joias_brand_story_enabled', true );
$brand_story_image_id = absint( get_theme_mod( 'ecommerce_joias_brand_story_image', 0 ) );
$brand_story_image    = '';
$brand_story_eyebrow = get_theme_mod( 'ecommerce_joias_brand_story_eyebrow', 'A essência da NC' );
$brand_story_title = get_theme_mod( 'ecommerce_joias_brand_story_title', 'Detalhes que acompanham histórias' );
$brand_story_description = get_theme_mod(
	'ecommerce_joias_brand_story_description',
	'Uma joia pode marcar uma conquista, celebrar um encontro ou simplesmente revelar um pouco mais do seu estilo todos os dias.'
);
$brand_story_button_label = get_theme_mod( 'ecommerce_joias_brand_story_button_label', 'Conheça a coleção' );
$brand_story_background = sanitize_hex_color(
	get_theme_mod( 'ecommerce_joias_brand_story_background', '#ae4540' )
);


$featured_categories = get_terms(
	array(
		'taxonomy'   => 'product_cat',
		'hide_empty' => true,
		'number'     => 0,
		'orderby'    => 'count',
		'order'      => 'DESC',
	)
);
$featured_products = function_exists( 'wc_get_products' )
	? wc_get_products(
		array(
			'limit'      => 4,
			'status'     => 'publish',
			'visibility' => 'catalog',
			'orderby'    => 'date',
			'order'      => 'DESC',
		)
	)
	: array();

if ( $hero_image_id ) {
	$hero_image = wp_get_attachment_image(
		$hero_image_id,
		'full',
		false,
		array(
			'alt'           => '',
			'class'         => 'nc-hero__image',
			'decoding'      => 'async',
			'fetchpriority' => 'high',
			'loading'       => 'eager',
		)
	);
}

if ( $brand_story_image_id ) {
	$brand_story_image = wp_get_attachment_image(
		$brand_story_image_id,
		'large',
		false,
		array(
			'alt'     => '',
			'class'   => 'nc-brand-story__image',
			'loading' => 'lazy',
		)
	);
}

$home_has_categories = ! is_wp_error( $featured_categories ) && (bool) $featured_categories;
$hero_next_background = $home_has_categories ? 'var(--nc-home-category-background)' : ( $featured_products ? 'var(--nc-home-product-background)' : ( $brand_story_enabled ? ( $brand_story_background ?: '#ae4540' ) : 'var(--nc-footer-background)' ) );
$product_previous_background = $home_has_categories ? 'var(--nc-home-category-background)' : 'var(--nc-home-product-background)';
$story_previous_background = $featured_products ? 'var(--nc-home-product-background)' : ( $home_has_categories ? 'var(--nc-home-category-background)' : ( $brand_story_background ?: '#ae4540' ) );

get_header();
?>

<main id="primary" class="site-main nc-home-page">
	<section class="nc-hero" style="--nc-home-next-background:<?php echo esc_attr( $hero_next_background ); ?>;">
		<?php if ( $hero_image ) : ?>
			<div class="nc-hero__media" aria-hidden="true">
				<?php echo wp_kses_post( $hero_image ); ?>
			</div>
		<?php endif; ?>

		<div class="nc-hero__content">
			<p class="nc-hero__eyebrow">NC Semijoias</p>

			<h1>Joias que contam histórias</h1>

			<p class="nc-hero__description">
				Peças escolhidas para acompanhar os seus momentos mais especiais.
			</p>

			<a class="wp-block-button__link" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
				Conheça a coleção
			</a>
		</div>
	</section>

	<?php if ( $home_has_categories ) : ?>
		<section class="nc-category-showcase" aria-labelledby="nc-category-showcase-title">
			<div class="nc-section-heading" data-home-reveal>
				<p class="nc-section-heading__eyebrow">Encontre a sua peça</p>

				<h2 id="nc-category-showcase-title">Explore por categoria</h2>

				<p>Descubra detalhes feitos para cada momento e estilo.</p>
			</div>

			<?php $category_carousel = (bool) get_theme_mod( 'ecommerce_joias_category_carousel', true ); ?>
			<div class="<?php echo $category_carousel ? 'nc-category-carousel' : 'nc-category-layout'; ?>" data-home-reveal style="--nc-category-card-width:<?php echo esc_attr( max( 140, min( 280, absint( get_theme_mod( 'ecommerce_joias_category_card_width', 200 ) ) ) ) ); ?>px" data-autoplay="<?php echo get_theme_mod( 'ecommerce_joias_category_autoplay', true ) ? 'true' : 'false'; ?>" data-speed="<?php echo esc_attr( max( 10, min( 80, absint( get_theme_mod( 'ecommerce_joias_category_speed', 28 ) ) ) ) ); ?>">
			<?php if ( $category_carousel ) : ?>
				<div class="nc-category-carousel__controls" hidden>
					<button type="button" class="nc-category-carousel__arrow" data-category-previous aria-controls="nc-category-track" aria-label="<?php esc_attr_e( 'Categorias anteriores', 'ecommerce-joias' ); ?>"><span aria-hidden="true">←</span></button>
					<button type="button" class="nc-category-carousel__arrow" data-category-next aria-controls="nc-category-track" aria-label="<?php esc_attr_e( 'Próximas categorias', 'ecommerce-joias' ); ?>"><span aria-hidden="true">→</span></button>
				</div>
			<?php endif; ?>
			<div id="nc-category-track" class="nc-category-grid<?php echo $category_carousel ? ' nc-category-carousel__track' : ''; ?>"<?php if ( $category_carousel ) : ?> role="region" aria-label="<?php esc_attr_e( 'Carrossel de categorias', 'ecommerce-joias' ); ?>" tabindex="0"<?php endif; ?>>
				<?php foreach ( $featured_categories as $category ) : ?>
					<?php
					$thumbnail_id = absint( get_term_meta( $category->term_id, 'thumbnail_id', true ) );
					$category_url = get_term_link( $category );
					?>

					<?php if ( ! is_wp_error( $category_url ) ) : ?>
						<a class="nc-category-card" href="<?php echo esc_url( $category_url ); ?>">
							<div class="nc-category-card__media">
								<?php if ( $thumbnail_id ) : ?>
									<?php
									echo wp_kses_post(
										wp_get_attachment_image(
											$thumbnail_id,
											'woocommerce_thumbnail',
											false,
											array(
												'alt'     => '',
												'loading' => 'lazy',
											)
										)
									);
									?>
								<?php else : ?>
									<span aria-hidden="true">✦</span>
								<?php endif; ?>
							</div>

							<span class="nc-category-card__name">
								<?php echo esc_html( $category->name ); ?>
							</span>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
			<?php if ( $category_carousel ) : ?>
				<button type="button" class="nc-category-carousel__playback" data-category-pause hidden aria-pressed="false" aria-controls="nc-category-track" data-pause-label="<?php esc_attr_e( 'Pausar movimento', 'ecommerce-joias' ); ?>" data-resume-label="<?php esc_attr_e( 'Retomar movimento', 'ecommerce-joias' ); ?>"><?php esc_html_e( 'Pausar movimento', 'ecommerce-joias' ); ?></button>
			<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $featured_products ) : ?>
		<section class="nc-product-showcase" aria-labelledby="nc-product-showcase-title" style="--nc-home-previous-background:<?php echo esc_attr( $product_previous_background ); ?>;">
			<div class="nc-section-heading" data-home-reveal>
				<p class="nc-section-heading__eyebrow">Acabou de chegar</p>

				<h2 id="nc-product-showcase-title">Novidades da coleção</h2>

				<p>Conheça as peças mais recentes da nossa seleção.</p>
			</div>

			<div class="nc-featured-product-grid">
				<?php foreach ( $featured_products as $product_index => $featured_product ) : ?>
					<article class="nc-featured-product" data-home-reveal style="--nc-home-reveal-delay:<?php echo esc_attr( $product_index * 70 ); ?>ms;">
						<a
							class="nc-featured-product__media"
							href="<?php echo esc_url( $featured_product->get_permalink() ); ?>"
						>
							<?php
							echo wp_kses_post(
								$featured_product->get_image(
									'woocommerce_thumbnail',
									array(
										'alt'     => $featured_product->get_name(),
										'loading' => 'lazy',
									)
								)
							);
							?>
						</a>

						<div class="nc-featured-product__content">
							<h3>
								<a href="<?php echo esc_url( $featured_product->get_permalink() ); ?>">
									<?php echo esc_html( $featured_product->get_name() ); ?>
								</a>
							</h3>

							<p class="nc-featured-product__price">
								<?php echo wp_kses_post( $featured_product->get_price_html() ); ?>
							</p>

							<a
								class="nc-featured-product__link"
								href="<?php echo esc_url( $featured_product->get_permalink() ); ?>"
							>
								<?php echo esc_html( get_theme_mod( 'ecommerce_joias_store_view_product_label', 'Ver produto' ) ); ?>
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="nc-product-showcase__action" data-home-reveal>
				<a class="wp-block-button__link" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
					Ver todos os produtos
				</a>
			</div>
		</section>
	<?php endif; ?>

	<?php if ( $brand_story_enabled ) : ?>
		<section
			class="nc-brand-story"
			aria-labelledby="nc-brand-story-title"
			style="--nc-home-previous-background:<?php echo esc_attr( $story_previous_background ); ?>;--nc-brand-story-background: <?php echo esc_attr( $brand_story_background ? $brand_story_background : '#ae4540' ); ?>;"
		>
			<div class="nc-brand-story__content" data-home-reveal>
				<p class="nc-section-heading__eyebrow">
					<?php echo esc_html( $brand_story_eyebrow ); ?>
				</p>

				<h2 id="nc-brand-story-title">
					<?php echo esc_html( $brand_story_title ); ?>
				</h2>

				<p>
					<?php echo nl2br( esc_html( $brand_story_description ) ); ?>
				</p>

				<a class="nc-brand-story__link" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>">
					<?php echo esc_html( $brand_story_button_label ); ?>
				</a>
			</div>

			<div class="nc-brand-story__art" aria-hidden="true" data-home-reveal>
				<?php if ( $brand_story_image ) : ?>
					<?php echo wp_kses_post( $brand_story_image ); ?>
				<?php else : ?>
					<span>✦</span>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>
</main>

<?php
get_footer();
