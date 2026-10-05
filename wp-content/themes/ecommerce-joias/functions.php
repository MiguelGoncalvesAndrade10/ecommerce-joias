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

/**
 * Adiciona as opções próprias da página inicial ao personalizador.
 *
 * @param WP_Customize_Manager $wp_customize Instância do personalizador.
 */
function ecommerce_joias_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'ecommerce_joias_home',
		array(
			'title'    => __( 'Página inicial', 'ecommerce-joias' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'ecommerce_joias_hero_image',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'ecommerce_joias_hero_image',
			array(
				'label'       => __( 'Imagem da hero', 'ecommerce-joias' ),
				'description' => __(
					'Escolha uma imagem horizontal para o banner principal da página inicial.',
					'ecommerce-joias'
				),
				'section'     => 'ecommerce_joias_home',
				'mime_type'   => 'image',
			)
		)
	);

	$wp_customize->add_setting(
		'ecommerce_joias_brand_story_enabled',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'ecommerce_joias_brand_story_enabled',
		array(
			'label'   => __( 'Exibir seção institucional', 'ecommerce-joias' ),
			'section' => 'ecommerce_joias_home',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'ecommerce_joias_brand_story_image',
		array(
			'default'           => 0,
			'sanitize_callback' => 'absint',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'ecommerce_joias_brand_story_image',
			array(
				'label'       => __( 'Imagem da seção institucional', 'ecommerce-joias' ),
				'description' => __(
					'Escolha uma imagem vertical ou próxima do formato quadrado.',
					'ecommerce-joias'
				),
				'section'     => 'ecommerce_joias_home',
				'mime_type'   => 'image',
			)
		)
	);

	$brand_story_text_settings = array(
		'ecommerce_joias_brand_story_eyebrow' => array(
			'label'    => __( 'Chamada curta da seção institucional', 'ecommerce-joias' ),
			'default'  => __( 'A essência da NC', 'ecommerce-joias' ),
			'type'     => 'text',
			'sanitize' => 'sanitize_text_field',
		),
		'ecommerce_joias_brand_story_title' => array(
			'label'    => __( 'Título da seção institucional', 'ecommerce-joias' ),
			'default'  => __( 'Detalhes que acompanham histórias', 'ecommerce-joias' ),
			'type'     => 'text',
			'sanitize' => 'sanitize_text_field',
		),
		'ecommerce_joias_brand_story_description' => array(
			'label'    => __( 'Texto da seção institucional', 'ecommerce-joias' ),
			'default'  => __( 'Uma joia pode marcar uma conquista, celebrar um encontro ou simplesmente revelar um pouco mais do seu estilo todos os dias.', 'ecommerce-joias' ),
			'type'     => 'textarea',
			'sanitize' => 'sanitize_textarea_field',
		),
		'ecommerce_joias_brand_story_button_label' => array(
			'label'    => __( 'Texto do botão da seção institucional', 'ecommerce-joias' ),
			'default'  => __( 'Conheça a coleção', 'ecommerce-joias' ),
			'type'     => 'text',
			'sanitize' => 'sanitize_text_field',
		),
	);

	foreach ( $brand_story_text_settings as $setting_id => $setting ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => $setting['sanitize'],
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				'label'   => $setting['label'],
				'section' => 'ecommerce_joias_home',
				'type'    => $setting['type'],
			)
		);
	}

	$wp_customize->add_section(
		'ecommerce_joias_about',
		array(
			'title'    => __( 'Sobre a loja', 'ecommerce-joias' ),
			'priority' => 30,
		)
	);

	$about_text_settings = array(
		'ecommerce_joias_about_eyebrow' => array( 'label' => __( 'Chamada curta', 'ecommerce-joias' ), 'default' => __( 'A essência da NC', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_about_title' => array( 'label' => __( 'Título principal', 'ecommerce-joias' ), 'default' => __( 'Joias para acompanhar a sua história', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_about_description' => array( 'label' => __( 'Texto de apresentação', 'ecommerce-joias' ), 'default' => __( 'Acreditamos em peças escolhidas para iluminar momentos, expressar estilo e se tornar parte das suas memórias.', 'ecommerce-joias' ), 'type' => 'textarea' ),
		'ecommerce_joias_about_story_title' => array( 'label' => __( 'Título da história', 'ecommerce-joias' ), 'default' => __( 'Detalhes que têm significado', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_about_story_description' => array( 'label' => __( 'Texto da história', 'ecommerce-joias' ), 'default' => __( 'Cada escolha da nossa coleção é guiada pelo cuidado com acabamento, versatilidade e beleza atemporal. Queremos que cada peça encontre o seu lugar nos dias que importam.', 'ecommerce-joias' ), 'type' => 'textarea' ),
		'ecommerce_joias_about_value_one' => array( 'label' => __( 'Primeiro valor', 'ecommerce-joias' ), 'default' => __( 'Cuidado nos detalhes', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_about_value_two' => array( 'label' => __( 'Segundo valor', 'ecommerce-joias' ), 'default' => __( 'Escolhas atemporais', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_about_value_three' => array( 'label' => __( 'Terceiro valor', 'ecommerce-joias' ), 'default' => __( 'Atendimento próximo', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_about_detail_one_title' => array( 'label' => __( 'Título do cartão Materiais', 'ecommerce-joias' ), 'default' => __( 'Materiais e acabamentos', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_about_detail_one_text' => array( 'label' => __( 'Texto do cartão Materiais', 'ecommerce-joias' ), 'default' => __( 'Apresente aqui os materiais, banhos e acabamentos que fazem parte da sua coleção.', 'ecommerce-joias' ), 'type' => 'textarea' ),
		'ecommerce_joias_about_detail_two_title' => array( 'label' => __( 'Título do cartão Cuidados', 'ecommerce-joias' ), 'default' => __( 'Cuidados com suas peças', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_about_detail_two_text' => array( 'label' => __( 'Texto do cartão Cuidados', 'ecommerce-joias' ), 'default' => __( 'Compartilhe orientações simples para conservar o brilho e aproveitar cada peça por mais tempo.', 'ecommerce-joias' ), 'type' => 'textarea' ),
		'ecommerce_joias_about_detail_three_title' => array( 'label' => __( 'Título do cartão Atendimento', 'ecommerce-joias' ), 'default' => __( 'Escolhas com segurança', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_about_detail_three_text' => array( 'label' => __( 'Texto do cartão Atendimento', 'ecommerce-joias' ), 'default' => __( 'Explique como sua equipe pode ajudar antes e depois da escolha de uma joia.', 'ecommerce-joias' ), 'type' => 'textarea' ),
	);

	foreach ( $about_text_settings as $setting_id => $setting ) {
		$wp_customize->add_setting( $setting_id, array( 'default' => $setting['default'], 'sanitize_callback' => 'textarea' === $setting['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field' ) );
		$wp_customize->add_control( $setting_id, array( 'label' => $setting['label'], 'section' => 'ecommerce_joias_about', 'type' => $setting['type'] ) );
	}

	$wp_customize->add_setting( 'ecommerce_joias_about_image', array( 'default' => 0, 'sanitize_callback' => 'absint' ) );
	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'ecommerce_joias_about_image', array( 'label' => __( 'Imagem da página', 'ecommerce-joias' ), 'description' => __( 'Prefira uma imagem vertical ou próxima do quadrado.', 'ecommerce-joias' ), 'section' => 'ecommerce_joias_about', 'mime_type' => 'image' ) ) );

	foreach ( array(
		'ecommerce_joias_about_background' => array( 'label' => __( 'Fundo da página', 'ecommerce-joias' ), 'default' => '#fffaf7' ),
		'ecommerce_joias_about_accent' => array( 'label' => __( 'Cor de destaque', 'ecommerce-joias' ), 'default' => '#ae4540' ),
	) as $setting_id => $setting ) {
		$wp_customize->add_setting( $setting_id, array( 'default' => $setting['default'], 'sanitize_callback' => 'sanitize_hex_color' ) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $setting_id, array( 'label' => $setting['label'], 'section' => 'ecommerce_joias_about' ) ) );
	}

	$wp_customize->add_section(
		'ecommerce_joias_products_page',
		array(
			'title'    => __( 'Página Produtos', 'ecommerce-joias' ),
			'priority' => 30,
		)
	);

	foreach ( array(
		'ecommerce_joias_products_page_eyebrow' => array( 'label' => __( 'Chamada curta', 'ecommerce-joias' ), 'default' => __( 'Explore a coleção', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_products_page_title' => array( 'label' => __( 'Título principal', 'ecommerce-joias' ), 'default' => __( 'Encontre a peça que combina com você', 'ecommerce-joias' ), 'type' => 'text' ),
		'ecommerce_joias_products_page_description' => array( 'label' => __( 'Texto de apresentação', 'ecommerce-joias' ), 'default' => __( 'Navegue pelas categorias e descubra peças para acompanhar cada momento.', 'ecommerce-joias' ), 'type' => 'textarea' ),
	) as $setting_id => $setting ) {
		$wp_customize->add_setting( $setting_id, array( 'default' => $setting['default'], 'sanitize_callback' => 'textarea' === $setting['type'] ? 'sanitize_textarea_field' : 'sanitize_text_field' ) );
		$wp_customize->add_control( $setting_id, array( 'label' => $setting['label'], 'section' => 'ecommerce_joias_products_page', 'type' => $setting['type'] ) );
	}

	$wp_customize->add_setting(
		'ecommerce_joias_brand_story_background',
		array(
			'default'           => '#ae4540',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'ecommerce_joias_brand_story_background',
			array(
				'label'   => __( 'Cor de fundo da seção institucional', 'ecommerce-joias' ),
				'section' => 'ecommerce_joias_home',
			)
		)
	);

	$wp_customize->add_section(
		'ecommerce_joias_header',
		array(
			'title'    => __( 'Cabeçalho NC', 'ecommerce-joias' ),
			'priority' => 31,
		)
	);

	$header_color_settings = array(
		'ecommerce_joias_header_top_background' => array(
			'label'   => __( 'Fundo da barra superior', 'ecommerce-joias' ),
			'default' => '#ae4540',
		),
		'ecommerce_joias_header_surface' => array(
			'label'   => __( 'Fundo principal do cabeçalho', 'ecommerce-joias' ),
			'default' => '#fffaf7',
		),
		'ecommerce_joias_header_navigation_background' => array(
			'label'   => __( 'Fundo da navegação', 'ecommerce-joias' ),
			'default' => '#fffaf7',
		),
		'ecommerce_joias_header_text' => array(
			'label'   => __( 'Texto e ícones do cabeçalho', 'ecommerce-joias' ),
			'default' => '#332927',
		),
		'ecommerce_joias_header_accent' => array(
			'label'   => __( 'Destaques, carrinho e item ativo', 'ecommerce-joias' ),
			'default' => '#ae4540',
		),
	);

	foreach ( $header_color_settings as $setting_id => $setting ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'   => $setting['label'],
					'section' => 'ecommerce_joias_header',
				)
			)
		);
	}

	$wp_customize->add_section(
		'ecommerce_joias_footer',
		array(
			'title'    => __( 'Rodapé NC', 'ecommerce-joias' ),
			'priority' => 32,
		)
	);

	$footer_text_settings = array(
		'ecommerce_joias_footer_description' => array(
			'label'    => __( 'Descrição da marca', 'ecommerce-joias' ),
			'default'  => __( 'Joias escolhidas para acompanhar momentos que merecem ser lembrados.', 'ecommerce-joias' ),
			'type'     => 'textarea',
			'sanitize' => 'sanitize_textarea_field',
		),
		'ecommerce_joias_footer_email' => array(
			'label'    => __( 'E-mail de atendimento', 'ecommerce-joias' ),
			'default'  => '',
			'type'     => 'email',
			'sanitize' => 'sanitize_email',
		),
		'ecommerce_joias_footer_instagram' => array(
			'label'    => __( 'URL do Instagram', 'ecommerce-joias' ),
			'default'  => '',
			'type'     => 'url',
			'sanitize' => 'esc_url_raw',
		),
		'ecommerce_joias_footer_copyright' => array(
			'label'    => __( 'Texto complementar de direitos autorais', 'ecommerce-joias' ),
			'default'  => __( 'Todos os direitos reservados.', 'ecommerce-joias' ),
			'type'     => 'text',
			'sanitize' => 'sanitize_text_field',
		),
	);

	foreach ( $footer_text_settings as $setting_id => $setting ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => $setting['sanitize'],
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				'label'   => $setting['label'],
				'section' => 'ecommerce_joias_footer',
				'type'    => $setting['type'],
			)
		);
	}

	$footer_color_settings = array(
		'ecommerce_joias_footer_background' => array(
			'label'   => __( 'Fundo do rodapé', 'ecommerce-joias' ),
			'default' => '#332927',
		),
		'ecommerce_joias_footer_text' => array(
			'label'   => __( 'Texto do rodapé', 'ecommerce-joias' ),
			'default' => '#fffaf7',
		),
	);

	foreach ( $footer_color_settings as $setting_id => $setting ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'   => $setting['label'],
					'section' => 'ecommerce_joias_footer',
				)
			)
		);
	}

	$wp_customize->add_section(
		'ecommerce_joias_store',
		array(
			'title'    => __( 'Loja NC', 'ecommerce-joias' ),
			'priority' => 33,
		)
	);

	$store_text_settings = array(
		'ecommerce_joias_store_add_to_cart_label' => array(
			'label'   => __( 'Texto para adicionar ao carrinho', 'ecommerce-joias' ),
			'default' => __( 'Adicionar ao carrinho', 'ecommerce-joias' ),
		),
		'ecommerce_joias_store_select_options_label' => array(
			'label'   => __( 'Texto para selecionar opções', 'ecommerce-joias' ),
			'default' => __( 'Selecionar opções', 'ecommerce-joias' ),
		),
		'ecommerce_joias_store_view_product_label' => array(
			'label'   => __( 'Texto para visualizar produto', 'ecommerce-joias' ),
			'default' => __( 'Ver produto', 'ecommerce-joias' ),
		),
		'ecommerce_joias_store_related_title' => array(
			'label'   => __( 'Título de produtos relacionados', 'ecommerce-joias' ),
			'default' => __( 'Você também pode gostar', 'ecommerce-joias' ),
		),
		'ecommerce_joias_store_reviews_label' => array(
			'label'   => __( 'Título da área de avaliações', 'ecommerce-joias' ),
			'default' => __( 'Avaliações', 'ecommerce-joias' ),
		),
		'ecommerce_joias_store_reviews_empty' => array(
			'label'   => __( 'Mensagem sem avaliações', 'ecommerce-joias' ),
			'default' => __( 'Ainda não há avaliações.', 'ecommerce-joias' ),
		),
		'ecommerce_joias_store_reviews_first' => array(
			'label'   => __( 'Convite para primeira avaliação', 'ecommerce-joias' ),
			'default' => __( 'Seja a primeira pessoa a avaliar', 'ecommerce-joias' ),
		),
		'ecommerce_joias_store_reviews_rating' => array(
			'label'   => __( 'Rótulo da nota da avaliação', 'ecommerce-joias' ),
			'default' => __( 'Sua avaliação', 'ecommerce-joias' ),
		),
		'ecommerce_joias_store_reviews_comment' => array(
			'label'   => __( 'Rótulo do texto da avaliação', 'ecommerce-joias' ),
			'default' => __( 'Sua opinião', 'ecommerce-joias' ),
		),
		'ecommerce_joias_store_reviews_submit' => array(
			'label'   => __( 'Texto do botão de enviar avaliação', 'ecommerce-joias' ),
			'default' => __( 'Enviar avaliação', 'ecommerce-joias' ),
		),
		'ecommerce_joias_store_account_menu_label' => array(
			'label'   => __( 'Texto do atalho Minha conta no menu', 'ecommerce-joias' ),
			'default' => __( 'Minha conta', 'ecommerce-joias' ),
		),
	);

	foreach ( $store_text_settings as $setting_id => $setting ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => 'sanitize_text_field',
			)
		);

		$wp_customize->add_control(
			$setting_id,
			array(
				'label'   => $setting['label'],
				'section' => 'ecommerce_joias_store',
				'type'    => 'text',
			)
		);
	}

	$store_color_settings = array(
		'ecommerce_joias_store_action_background' => array(
			'label'   => __( 'Fundo dos botões de compra', 'ecommerce-joias' ),
			'default' => '#ae4540',
		),
		'ecommerce_joias_store_action_text' => array(
			'label'   => __( 'Texto dos botões de compra', 'ecommerce-joias' ),
			'default' => '#ffffff',
		),
		'ecommerce_joias_store_page_header_background' => array(
			'label'   => __( 'Fundo da faixa de contexto das páginas', 'ecommerce-joias' ),
			'default' => '#f2deda',
		),
		'ecommerce_joias_store_page_header_text' => array(
			'label'   => __( 'Texto da faixa de contexto das páginas', 'ecommerce-joias' ),
			'default' => '#332927',
		),
		'ecommerce_joias_store_mini_cart_background' => array(
			'label'   => __( 'Fundo do mini-carrinho', 'ecommerce-joias' ),
			'default' => '#332927',
		),
		'ecommerce_joias_store_mini_cart_text' => array(
			'label'   => __( 'Texto do mini-carrinho', 'ecommerce-joias' ),
			'default' => '#fffaf7',
		),
		'ecommerce_joias_store_account_navigation_background' => array(
			'label'   => __( 'Fundo da navegação de Minha conta', 'ecommerce-joias' ),
			'default' => '#fffaf7',
		),
		'ecommerce_joias_store_account_navigation_text' => array(
			'label'   => __( 'Texto da navegação de Minha conta', 'ecommerce-joias' ),
			'default' => '#332927',
		),
		'ecommerce_joias_store_account_navigation_active' => array(
			'label'   => __( 'Fundo do item ativo de Minha conta', 'ecommerce-joias' ),
			'default' => '#ae4540',
		),
	);

	foreach ( $store_color_settings as $setting_id => $setting ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $setting['default'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'   => $setting['label'],
					'section' => 'ecommerce_joias_store',
				)
			)
		);
	}

	$wp_customize->add_setting(
		'ecommerce_joias_store_page_header_enabled',
		array(
			'default'           => false,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'ecommerce_joias_store_page_header_enabled',
		array(
			'label'       => __( 'Exibir faixa de contexto nas páginas', 'ecommerce-joias' ),
			'description' => __( 'Quando desativada, o conteúdo começa logo após o cabeçalho do site.', 'ecommerce-joias' ),
			'section'     => 'ecommerce_joias_store',
			'type'        => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'ecommerce_joias_store_account_menu_enabled',
		array(
			'default'           => true,
			'sanitize_callback' => 'wp_validate_boolean',
		)
	);

	$wp_customize->add_control(
		'ecommerce_joias_store_account_menu_enabled',
		array(
			'label'       => __( 'Exibir atalho Minha conta no menu principal', 'ecommerce-joias' ),
			'description' => __( 'O atalho abre a página de pedidos, endereços e dados do cliente.', 'ecommerce-joias' ),
			'section'     => 'ecommerce_joias_store',
			'type'        => 'checkbox',
		)
	);
}
add_action( 'customize_register', 'ecommerce_joias_customize_register' );

/**
 * Injeta as cores configuradas depois do CSS do tema filho.
 */
function ecommerce_joias_enqueue_header_color_variables() {
	$theme_colors = array(
		'--nc-header-top-background' => get_theme_mod( 'ecommerce_joias_header_top_background', '#ae4540' ),
		'--nc-header-surface'        => get_theme_mod( 'ecommerce_joias_header_surface', '#fffaf7' ),
		'--nc-header-navigation-background' => get_theme_mod(
			'ecommerce_joias_header_navigation_background',
			'#fffaf7'
		),
		'--nc-header-text'           => get_theme_mod( 'ecommerce_joias_header_text', '#332927' ),
		'--nc-header-accent'         => get_theme_mod( 'ecommerce_joias_header_accent', '#ae4540' ),
		'--nc-footer-background'     => get_theme_mod( 'ecommerce_joias_footer_background', '#332927' ),
		'--nc-footer-text'           => get_theme_mod( 'ecommerce_joias_footer_text', '#fffaf7' ),
		'--nc-store-action-background' => get_theme_mod(
			'ecommerce_joias_store_action_background',
			'#ae4540'
		),
		'--nc-store-action-text' => get_theme_mod( 'ecommerce_joias_store_action_text', '#ffffff' ),
		'--nc-store-page-header-background' => get_theme_mod(
			'ecommerce_joias_store_page_header_background',
			'#f2deda'
		),
		'--nc-store-page-header-text' => get_theme_mod(
			'ecommerce_joias_store_page_header_text',
			'#332927'
		),
		'--nc-store-mini-cart-background' => get_theme_mod(
			'ecommerce_joias_store_mini_cart_background',
			'#332927'
		),
		'--nc-store-mini-cart-text' => get_theme_mod(
			'ecommerce_joias_store_mini_cart_text',
			'#fffaf7'
		),
		'--nc-store-account-navigation-background' => get_theme_mod(
			'ecommerce_joias_store_account_navigation_background',
			'#fffaf7'
		),
		'--nc-store-account-navigation-text' => get_theme_mod(
			'ecommerce_joias_store_account_navigation_text',
			'#332927'
		),
		'--nc-store-account-navigation-active' => get_theme_mod(
			'ecommerce_joias_store_account_navigation_active',
			'#ae4540'
		),
		'--nc-about-background' => get_theme_mod( 'ecommerce_joias_about_background', '#fffaf7' ),
		'--nc-about-accent' => get_theme_mod( 'ecommerce_joias_about_accent', '#ae4540' ),
	);

	$css_variables = array();

	foreach ( $theme_colors as $variable => $color ) {
		$css_variables[] = $variable . ': ' . ( sanitize_hex_color( $color ) ?: '#ae4540' ) . ';';
	}

	wp_add_inline_style(
		'ecommerce-joias-style',
		':root {' . implode( '', $css_variables ) . '}'
	);
}
add_action( 'wp_enqueue_scripts', 'ecommerce_joias_enqueue_header_color_variables', 40 );

/**
 * Personaliza os rótulos de compra do WooCommerce pelo Personalizador.
 *
 * @param string     $text    Rótulo original.
 * @param WC_Product $product Produto do contexto atual.
 * @return string
 */
function ecommerce_joias_product_add_to_cart_text( $text, $product ) {
	if ( ! $product instanceof WC_Product ) {
		return $text;
	}

	if ( $product->is_type( 'variable' ) ) {
		return get_theme_mod( 'ecommerce_joias_store_select_options_label', 'Selecionar opções' );
	}

	if ( $product->is_type( 'simple' ) ) {
		return get_theme_mod( 'ecommerce_joias_store_add_to_cart_label', 'Adicionar ao carrinho' );
	}

	return get_theme_mod( 'ecommerce_joias_store_view_product_label', 'Ver produto' );
}
add_filter( 'woocommerce_product_add_to_cart_text', 'ecommerce_joias_product_add_to_cart_text', 10, 2 );

/**
 * Personaliza o rótulo do botão de compra na página individual.
 *
 * @param string     $text    Rótulo original.
 * @param WC_Product $product Produto do contexto atual.
 * @return string
 */
function ecommerce_joias_single_add_to_cart_text( $text, $product ) {
	if ( $product instanceof WC_Product && $product->is_type( 'simple' ) ) {
		return get_theme_mod( 'ecommerce_joias_store_add_to_cart_label', 'Adicionar ao carrinho' );
	}

	return $text;
}
add_filter( 'woocommerce_product_single_add_to_cart_text', 'ecommerce_joias_single_add_to_cart_text', 10, 2 );

/**
 * Personaliza o título da vitrine de produtos relacionados.
 *
 * @return string
 */
function ecommerce_joias_related_products_title() {
	return get_theme_mod( 'ecommerce_joias_store_related_title', 'Você também pode gostar' );
}
add_filter( 'woocommerce_product_related_products_heading', 'ecommerce_joias_related_products_title' );

/**
 * Traduz os textos nativos da área de avaliações de um produto.
 *
 * O WooCommerce não expõe controles próprios para esses rótulos. O filtro é
 * limitado às páginas de produto e ao seu domínio de tradução para não alterar
 * textos iguais em outras áreas do site.
 *
 * @param string $translated Texto após a tradução do WordPress.
 * @param string $text       Texto original solicitado.
 * @param string $domain     Domínio de tradução.
 * @return string
 */
function ecommerce_joias_product_review_text( $translated, $text, $domain ) {
	if ( 'woocommerce' !== $domain || ! is_product() ) {
		return $translated;
	}

	$review_label = get_theme_mod( 'ecommerce_joias_store_reviews_label', 'Avaliações' );
	$translations = array(
		'Reviews'                    => $review_label,
		'Reviews (%d)'               => $review_label . ' (%d)',
		'Category:'                   => 'Categoria:',
		'Categories:'                 => 'Categorias:',
		'There are no reviews yet.'  => get_theme_mod( 'ecommerce_joias_store_reviews_empty', 'Ainda não há avaliações.' ),
		'Your rating'                => get_theme_mod( 'ecommerce_joias_store_reviews_rating', 'Sua avaliação' ),
		'Your review'                => get_theme_mod( 'ecommerce_joias_store_reviews_comment', 'Sua opinião' ),
		'Submit'                     => get_theme_mod( 'ecommerce_joias_store_reviews_submit', 'Enviar avaliação' ),
		'Rate&hellip;'               => 'Selecione uma nota&hellip;',
		'Perfect'                    => 'Excelente',
		'Good'                       => 'Bom',
		'Average'                    => 'Regular',
		'Not that bad'               => 'Ruim',
		'Very poor'                  => 'Péssimo',
	);

	if ( 'Be the first to review &ldquo;%s&rdquo;' === $text ) {
		return get_theme_mod( 'ecommerce_joias_store_reviews_first', 'Seja a primeira pessoa a avaliar' ) . ' &ldquo;%s&rdquo;';
	}

	if ( 'Add a review' === $text ) {
		return 'Adicionar uma avaliação';
	}

	return isset( $translations[ $text ] ) ? $translations[ $text ] : $translated;
}
add_filter( 'gettext', 'ecommerce_joias_product_review_text', 20, 3 );

/**
 * Traduz os textos de busca e resultados vazios herdados do tema-pai.
 *
 * @param string $translated Texto após a tradução do WordPress.
 * @param string $text       Texto original solicitado.
 * @param string $domain     Domínio de tradução.
 * @return string
 */
function ecommerce_joias_translate_empty_state_strings( $translated, $text, $domain ) {
	if ( 'orchid-store' !== $domain ) {
		return $translated;
	}

	$translations = array(
		'Nothing Found' => 'Nada encontrado',
		'Search Results for: %s' => 'Resultados da busca por: %s',
		'Sorry, but nothing matched your search terms. Please try again with some different keywords.' => 'Não encontramos resultados para a sua busca. Tente usar outras palavras.',
		'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.' => 'Não encontramos esta página. Uma nova busca pode ajudar.',
	);

	return isset( $translations[ $text ] ) ? $translations[ $text ] : $translated;
}
add_filter( 'gettext', 'ecommerce_joias_translate_empty_state_strings', 20, 3 );

/**
 * Mostra o primeiro item do caminho de navegação em português.
 *
 * @param array $crumbs Itens do caminho de navegação.
 * @return array
 */
function ecommerce_joias_translate_woocommerce_breadcrumb_home( $crumbs ) {
	if ( ! empty( $crumbs[0][0] ) ) {
		$crumbs[0][0] = 'Início';
	}

	return $crumbs;
}
add_filter( 'woocommerce_get_breadcrumb', 'ecommerce_joias_translate_woocommerce_breadcrumb_home' );

/**
 * Permite ocultar a faixa de contexto em todas as páginas do tema-pai.
 *
 * @param string[] $classes Classes atuais do elemento body.
 * @return string[]
 */
function ecommerce_joias_store_page_header_body_class( $classes ) {
	if ( ! get_theme_mod( 'ecommerce_joias_store_page_header_enabled', false ) ) {
		$classes[] = 'nc-store-page-header-hidden';
	}

	return $classes;
}
add_filter( 'body_class', 'ecommerce_joias_store_page_header_body_class' );

/**
 * Acrescenta um atalho configurável de Minha conta ao menu principal.
 *
 * @param string   $items Itens HTML do menu.
 * @param stdClass $args  Argumentos usados pelo wp_nav_menu().
 * @return string
 */
function ecommerce_joias_add_account_menu_item( $items, $args ) {
	if (
		'menu-1' !== $args->theme_location ||
		! get_theme_mod( 'ecommerce_joias_store_account_menu_enabled', true )
	) {
		return $items;
	}

	$account_page_id = wc_get_page_id( 'myaccount' );

	if ( $account_page_id < 1 ) {
		return $items;
	}

	$account_url = get_permalink( $account_page_id );

	if ( false !== strpos( $items, $account_url ) ) {
		return $items;
	}

	$label = get_theme_mod( 'ecommerce_joias_store_account_menu_label', 'Minha conta' );

	return $items . sprintf(
		'<li class="menu-item nc-account-menu-item"><a href="%1$s">%2$s</a></li>',
		esc_url( $account_url ),
		esc_html( $label )
	);
}
add_filter( 'wp_nav_menu_items', 'ecommerce_joias_add_account_menu_item', 10, 2 );

/**
 * Exibe os metadados do produto com rótulos consistentes em português.
 *
 * Substituímos somente este trecho do template padrão, mantendo os mesmos
 * hooks e as listas nativas do WooCommerce para categorias e etiquetas.
 */
function ecommerce_joias_product_meta() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	?>
	<div class="product_meta">
		<?php do_action( 'woocommerce_product_meta_start' ); ?>

		<?php if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ) : ?>
			<span class="sku_wrapper"><?php esc_html_e( 'SKU:', 'ecommerce-joias' ); ?> <span class="sku"><?php echo $product->get_sku() ? esc_html( $product->get_sku() ) : esc_html__( 'Não informado', 'ecommerce-joias' ); ?></span></span>
		<?php endif; ?>

		<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<span class="posted_in">Categoria: ', '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WooCommerce escapa os links de categoria. ?>
		<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<span class="tagged_as">Etiquetas: ', '</span>' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- WooCommerce escapa os links de etiqueta. ?>

		<?php do_action( 'woocommerce_product_meta_end' ); ?>
	</div>
	<?php
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_single_product_summary', 'ecommerce_joias_product_meta', 40 );

/**
 * Carrega o efeito parallax somente na página inicial.
 */
function ecommerce_joias_enqueue_hero_parallax() {
	if ( ! is_front_page() ) {
		return;
	}

	$script_path = get_stylesheet_directory() . '/assets/js/hero-parallax.js';

	wp_enqueue_script(
		'ecommerce-joias-hero-parallax',
		get_stylesheet_directory_uri() . '/assets/js/hero-parallax.js',
		array(),
		(string) filemtime( $script_path ),
		true
	);
}
add_action( 'wp_enqueue_scripts', 'ecommerce_joias_enqueue_hero_parallax', 30 );
