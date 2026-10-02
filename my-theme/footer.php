<?php
$footer_text      = get_theme_mod(
    'footer_text',
    'Joias escolhidas para tornar cada momento ainda mais especial.'
);

$footer_email     = get_theme_mod('footer_email', '');
$footer_whatsapp  = get_theme_mod('footer_whatsapp', '');
$footer_instagram = get_theme_mod('footer_instagram', '');
$footer_endereco  = get_theme_mod('footer_endereco', '');

$whatsapp_number = preg_replace('/\D+/', '', $footer_whatsapp);
?>

<footer class="site-footer">

    <!-- Parte principal -->
    <div class="footer-main">

        <div class="site-container footer-grid">

            <!-- MARCA -->
            <div class="footer-brand">

                <?php if (has_custom_logo()) : ?>

                    <div class="footer-logo">
                        <?php the_custom_logo(); ?>
                    </div>

                <?php else : ?>

                    <a
                        href="<?php echo esc_url(home_url('/')); ?>"
                        class="footer-brand-link"
                    >
                        <span class="footer-monogram">NC</span>

                        <span class="footer-brand-name">
                            <?php bloginfo('name'); ?>
                        </span>
                    </a>

                <?php endif; ?>

                <p class="footer-description">
                    <?php echo esc_html($footer_text); ?>
                </p>

            </div>


            <!-- NAVEGAÇÃO -->
            <div class="footer-column">

                <h3>Explore</h3>

                <ul>

                    <li>
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            Início
                        </a>
                    </li>

                    <?php if (class_exists('WooCommerce')) : ?>

                        <li>
                            <a href="<?php echo esc_url(
                                wc_get_page_permalink('shop')
                            ); ?>">
                                Loja
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo esc_url(
                                wc_get_page_permalink('myaccount')
                            ); ?>">
                                Minha conta
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo esc_url(
                                wc_get_cart_url()
                            ); ?>">
                                Carrinho
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>

            </div>


            <!-- ATENDIMENTO -->
            <div class="footer-column">

                <h3>Atendimento</h3>

                <ul>

                    <?php if ($footer_whatsapp) : ?>

                        <li>
                            <a
                                href="<?php echo esc_url(
                                    'https://wa.me/' . $whatsapp_number
                                ); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                WhatsApp
                            </a>
                        </li>

                    <?php endif; ?>


                    <?php if ($footer_email) : ?>

                        <li>
                            <a href="mailto:<?php echo esc_attr($footer_email); ?>">
                                <?php echo esc_html($footer_email); ?>
                            </a>
                        </li>

                    <?php endif; ?>


                    <?php if ($footer_instagram) : ?>

                        <li>
                            <a
                                href="<?php echo esc_url($footer_instagram); ?>"
                                target="_blank"
                                rel="noopener noreferrer"
                            >
                                Instagram
                            </a>
                        </li>

                    <?php endif; ?>

                </ul>

            </div>


            <!-- LOCALIZAÇÃO -->
            <div class="footer-column">

                <h3>NC Semijoias</h3>

                <?php if ($footer_endereco) : ?>

                    <p class="footer-address">
                        <?php echo esc_html($footer_endereco); ?>
                    </p>

                <?php endif; ?>

                <p class="footer-detail">
                    Prata 925 e semijoias selecionadas.
                </p>

            </div>

        </div>

    </div>


    <!-- Frase -->
    <div class="footer-message">

        <div class="site-container">

            <span class="footer-flower">✦</span>

            <p>
                Um detalhe pode transformar um momento.
            </p>

            <span class="footer-flower">✦</span>

        </div>

    </div>


    <!-- Rodapé final -->
    <div class="footer-bottom">

        <div class="site-container footer-bottom-content">

            <p>
                © <?php echo esc_html(date('Y')); ?>
                <?php bloginfo('name'); ?>.
                Todos os direitos reservados.
            </p>

            <p class="footer-credit">
                Feito com carinho em Minas Gerais.
            </p>

        </div>

    </div>

</footer>

<?php wp_footer(); ?>

</body>
</html>