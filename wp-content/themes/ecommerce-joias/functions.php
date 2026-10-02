<?php
/**
 * Inicialização do tema filho Ecommerce Joias.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Carrega os estilos próprios depois do CSS e das opções visuais do Orchid Store.
 */
function ecommerce_joias_enqueue_styles() {

	// O pai usa get_stylesheet_uri(), que aponta para o filho quando ele está ativo.
	wp_dequeue_style( 'orchid-store-style' );
	wp_deregister_style( 'orchid-store-style' );
	wp_enqueue_style(
		'orchid-store-style',
		get_template_directory_uri() . '/style.css',
		array(),
		wp_get_theme( get_template() )->get( 'Version' )
	);

	$stylesheet_path = get_stylesheet_directory() . '/style.css';
	$parent_handle   = is_rtl() ? 'orchid-store-main-style-rtl' : 'orchid-store-main-style';

	wp_enqueue_style(
		'ecommerce-joias-style',
		get_stylesheet_uri(),
		array( 'orchid-store-style', $parent_handle ),
		(string) filemtime( $stylesheet_path )
	);
}
add_action( 'wp_enqueue_scripts', 'ecommerce_joias_enqueue_styles', 20 );

// Adicione abaixo as funções e os hooks específicos da loja.
