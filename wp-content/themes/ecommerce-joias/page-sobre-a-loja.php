<?php
/**
 * Página institucional da loja.
 *
 * @package Ecommerce_Joias
 */

get_header();

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

<main id="primary" class="site-main nc-about-page">
	<section class="nc-about-hero">
		<div class="nc-about-hero__content">
			<p class="nc-section-heading__eyebrow"><?php echo esc_html( $about['eyebrow'] ); ?></p>
			<h1><?php echo esc_html( $about['title'] ); ?></h1>
			<p><?php echo esc_html( $about['description'] ); ?></p>
		</div>
	</section>

	<section class="nc-about-story">
		<div class="nc-about-story__media">
			<?php if ( $about['image_id'] ) : ?>
				<?php echo wp_get_attachment_image( $about['image_id'], 'large', false, array( 'class' => 'nc-about-story__image' ) ); ?>
			<?php else : ?>
				<span aria-hidden="true">NC</span>
			<?php endif; ?>
		</div>
		<div class="nc-about-story__content">
			<h2><?php echo esc_html( $about['story_title'] ); ?></h2>
			<p><?php echo esc_html( $about['story_description'] ); ?></p>
		</div>
	</section>

	<section class="nc-about-values" aria-label="<?php esc_attr_e( 'Valores da loja', 'ecommerce-joias' ); ?>">
		<?php foreach ( $about['values'] as $index => $value ) : ?>
			<article>
				<span>0<?php echo esc_html( $index + 1 ); ?></span>
				<h2><?php echo esc_html( $value ); ?></h2>
			</article>
		<?php endforeach; ?>
	</section>

	<section class="nc-about-details" aria-label="<?php esc_attr_e( 'Informações da loja', 'ecommerce-joias' ); ?>">
		<?php foreach ( $about['details'] as $detail ) : ?>
			<article>
				<h2><?php echo esc_html( $detail[0] ); ?></h2>
				<p><?php echo esc_html( $detail[1] ); ?></p>
			</article>
		<?php endforeach; ?>
	</section>

	<?php while ( have_posts() ) : the_post(); ?>
		<?php if ( trim( get_the_content() ) ) : ?>
			<div class="nc-about-page__editor-content"><?php the_content(); ?></div>
		<?php endif; ?>
	<?php endwhile; ?>
</main>

<?php get_footer();
