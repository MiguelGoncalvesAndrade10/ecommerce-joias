<?php
/**
 * Template Name: Sobre a loja
 *
 * Página institucional da loja.
 *
 * @package Ecommerce_Joias
 */

get_header();

$hero_image = absint( get_theme_mod( 'ecommerce_joias_about_hero_image', 0 ) );
$closing_image = absint( get_theme_mod( 'ecommerce_joias_about_closing_image', 0 ) );
$shop_page = get_page_by_path( 'produtos' );
$closing_url = get_theme_mod( 'ecommerce_joias_about_closing_url', '' );
if ( ! $closing_url ) {
	$closing_url = $shop_page ? get_permalink( $shop_page ) : ( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) );
}
$about_classes = 'site-main nc-about-page';
foreach ( array( 'hover' => true, 'sticky' => false ) as $effect => $default ) {
	if ( get_theme_mod( 'ecommerce_joias_about_' . $effect, $default ) ) {
		$about_classes .= ' nc-about-page--' . $effect;
	}
}
$about_style = sprintf( '--nc-about-height:%dsvh;--nc-about-overlay:%s;--nc-about-hero-position:%d%%;--nc-about-closing-position:%d%%;', max( 45, min( 100, absint( get_theme_mod( 'ecommerce_joias_about_hero_height', 80 ) ) ) ), max( 0, min( 80, absint( get_theme_mod( 'ecommerce_joias_about_overlay', 35 ) ) ) ) / 100, absint( get_theme_mod( 'ecommerce_joias_about_hero_position', 50 ) ), absint( get_theme_mod( 'ecommerce_joias_about_closing_position', 50 ) ) );
$about_style .= '--nc-about-pop-scale:' . ( 1 - max( 4, min( 45, absint( get_theme_mod( 'ecommerce_joias_about_pop_intensity', 28 ) ) ) ) / 100 ) . ';';
$about_style .= '--nc-about-pop-duration:' . max( 300, min( 1200, absint( get_theme_mod( 'ecommerce_joias_about_pop_duration', 900 ) ) ) ) . 'ms;';
foreach ( array( 'text' => '#332927', 'photo_text' => '#ffffff' ) as $key => $default ) {
	$about_style .= '--nc-about-' . str_replace( '_', '-', $key ) . ':' . ( sanitize_hex_color( get_theme_mod( 'ecommerce_joias_about_' . $key, $default ) ) ?: $default ) . ';';
}

$about = array(
	'eyebrow' => get_theme_mod( 'ecommerce_joias_about_eyebrow', 'A essência da NC' ),
	'title' => get_theme_mod( 'ecommerce_joias_about_title', 'Joias para acompanhar a sua história' ),
	'description' => get_theme_mod( 'ecommerce_joias_about_description', 'Acreditamos em peças escolhidas para iluminar momentos, expressar estilo e se tornar parte das suas memórias.' ),
	'story_title' => get_theme_mod( 'ecommerce_joias_about_story_title', 'Detalhes que têm significado' ),
	'story_description' => get_theme_mod( 'ecommerce_joias_about_story_description', 'Cada escolha da nossa coleção é guiada pelo cuidado com acabamento, versatilidade e beleza atemporal. Queremos que cada peça encontre o seu lugar nos dias que importam.' ),
	'image_id' => absint( get_theme_mod( 'ecommerce_joias_about_image', 0 ) ),
	'values' => array(
		get_theme_mod( 'ecommerce_joias_about_value_one', 'Cuidado nos detalhes' ),
		get_theme_mod( 'ecommerce_joias_about_value_two', 'Escolhas atemporais' ),
		get_theme_mod( 'ecommerce_joias_about_value_three', 'Atendimento próximo' ),
	),
	'details' => array(
		array( get_theme_mod( 'ecommerce_joias_about_detail_one_title', 'Materiais e acabamentos' ), get_theme_mod( 'ecommerce_joias_about_detail_one_text', 'Apresente aqui os materiais, banhos e acabamentos que fazem parte da sua coleção.' ) ),
		array( get_theme_mod( 'ecommerce_joias_about_detail_two_title', 'Cuidados com suas peças' ), get_theme_mod( 'ecommerce_joias_about_detail_two_text', 'Compartilhe orientações simples para conservar o brilho e aproveitar cada peça por mais tempo.' ) ),
		array( get_theme_mod( 'ecommerce_joias_about_detail_three_title', 'Escolhas com segurança' ), get_theme_mod( 'ecommerce_joias_about_detail_three_text', 'Explique como sua equipe pode ajudar antes e depois da escolha de uma joia.' ) ),
	),
);
?>

<main id="primary" class="<?php echo esc_attr( $about_classes ); ?>" style="<?php echo esc_attr( $about_style ); ?>" data-reveal="<?php echo get_theme_mod( 'ecommerce_joias_about_reveal', true ) ? 'true' : 'false'; ?>" data-parallax="<?php echo get_theme_mod( 'ecommerce_joias_about_parallax', true ) ? 'true' : 'false'; ?>" data-parallax-strength="<?php echo esc_attr( min( 120, absint( get_theme_mod( 'ecommerce_joias_about_parallax_strength', 60 ) ) ) ); ?>">
	<section class="nc-about-hero<?php echo $hero_image ? ' nc-about-photo' : ''; ?>">
		<?php if ( $hero_image ) : ?>
			<div class="nc-about-hero__media" aria-hidden="true"><?php echo wp_get_attachment_image( $hero_image, 'full', false, array( 'alt' => '', 'loading' => 'eager', 'fetchpriority' => 'high', 'sizes' => '100vw' ) ); ?></div>
		<?php endif; ?>
		<div class="nc-about-hero__content">
			<p class="nc-section-heading__eyebrow"><?php echo esc_html( $about['eyebrow'] ); ?></p>
			<h1><?php echo esc_html( $about['title'] ); ?></h1>
			<p><?php echo esc_html( $about['description'] ); ?></p>
		</div>
	</section>

	<section class="nc-about-story">
		<div class="nc-about-story__media" data-about-reveal data-pop-depth="<?php echo esc_attr( max( 15, min( 65, absint( get_theme_mod( 'ecommerce_joias_about_pop_depth', 45 ) ) ) ) ); ?>"<?php echo get_theme_mod( 'ecommerce_joias_about_photo_pop', true ) ? ' data-about-pop' : ''; ?>>
			<?php if ( $about['image_id'] ) : ?>
				<?php echo wp_get_attachment_image( $about['image_id'], 'large', false, array( 'class' => 'nc-about-story__image' ) ); ?>
			<?php else : ?>
				<span aria-hidden="true">NC</span>
			<?php endif; ?>
		</div>
		<div class="nc-about-story__content" data-about-reveal>
			<h2><?php echo esc_html( $about['story_title'] ); ?></h2>
			<p><?php echo esc_html( $about['story_description'] ); ?></p>
		</div>
	</section>

	<section class="nc-about-values" aria-label="<?php esc_attr_e( 'Valores da loja', 'ecommerce-joias' ); ?>">
		<?php foreach ( $about['values'] as $index => $value ) : ?>
			<article data-about-reveal style="--nc-reveal-delay:<?php echo esc_attr( $index * 100 ); ?>ms">
				<span>0<?php echo esc_html( $index + 1 ); ?></span>
				<h2><?php echo esc_html( $value ); ?></h2>
			</article>
		<?php endforeach; ?>
	</section>

	<section class="nc-about-details" aria-label="<?php esc_attr_e( 'Informações da loja', 'ecommerce-joias' ); ?>">
		<?php foreach ( $about['details'] as $detail ) : ?>
			<article data-about-reveal>
				<h2><?php echo esc_html( $detail[0] ); ?></h2>
				<p><?php echo esc_html( $detail[1] ); ?></p>
			</article>
		<?php endforeach; ?>
	</section>

	<?php if ( get_theme_mod( 'ecommerce_joias_about_show_closing', true ) ) : ?>
		<section class="nc-about-closing<?php echo $closing_image ? ' nc-about-photo' : ''; ?>">
			<?php if ( $closing_image ) : ?>
				<div class="nc-about-closing__media" aria-hidden="true"><?php echo wp_get_attachment_image( $closing_image, 'large', false, array( 'alt' => '', 'loading' => 'lazy', 'sizes' => '100vw' ) ); ?></div>
			<?php endif; ?>
			<div class="nc-about-closing__content" data-about-reveal>
				<h2><?php echo esc_html( get_theme_mod( 'ecommerce_joias_about_closing_title', 'Encontre a joia que faz parte da sua história' ) ); ?></h2>
				<p><?php echo esc_html( get_theme_mod( 'ecommerce_joias_about_closing_description', 'Conheça nossas peças e escolha os detalhes que acompanham você.' ) ); ?></p>
				<?php if ( get_theme_mod( 'ecommerce_joias_about_closing_button', 'Conheça nossa coleção' ) ) : ?>
					<a class="nc-about-closing__button" href="<?php echo esc_url( $closing_url ); ?>"><?php echo esc_html( get_theme_mod( 'ecommerce_joias_about_closing_button', 'Conheça nossa coleção' ) ); ?></a>
				<?php endif; ?>
			</div>
		</section>
	<?php endif; ?>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( trim( get_the_content() ) ) : ?>
			<div class="nc-about-page__editor-content"><?php the_content(); ?></div>
		<?php endif; ?>
	<?php endwhile; ?>
</main>

<?php get_footer();
