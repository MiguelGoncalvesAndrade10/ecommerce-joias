<?php
/**
 * Página inicial da NC Semijoias.
 *
 * @package Ecommerce_Joias
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
		'number'     => 4,
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

get_header();
?>

<main id="primary" class="site-main">
	<section class="nc-hero">
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

	<?php if ( ! is_wp_error( $featured_categories ) && $featured_categories ) : ?>
		<section class="nc-category-showcase" aria-labelledby="nc-category-showcase-title">
			<div class="nc-section-heading">
				<p class="nc-section-heading__eyebrow">Encontre a sua peça</p>

				<h2 id="nc-category-showcase-title">Explore por categoria</h2>

				<p>Descubra detalhes feitos para cada momento e estilo.</p>
			</div>

			<div class="nc-category-grid">
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
		</section>
	<?php endif; ?>

	<?php if ( $featured_products ) : ?>
		<section class="nc-product-showcase" aria-labelledby="nc-product-showcase-title">
			<div class="nc-section-heading">
				<p class="nc-section-heading__eyebrow">Acabou de chegar</p>

				<h2 id="nc-product-showcase-title">Novidades da coleção</h2>

				<p>Conheça as peças mais recentes da nossa seleção.</p>
			</div>

			<div class="nc-featured-product-grid">
				<?php foreach ( $featured_products as $featured_product ) : ?>
					<article class="nc-featured-product">
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
								Ver produto
							</a>
						</div>
					</article>
				<?php endforeach; ?>
			</div>

			<div class="nc-product-showcase__action">
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
			style="--nc-brand-story-background: <?php echo esc_attr( $brand_story_background ? $brand_story_background : '#ae4540' ); ?>;"
		>
			<div class="nc-brand-story__content">
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

			<div class="nc-brand-story__art" aria-hidden="true">
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
