<?php get_header(); ?>

<main>

    <section class="hero">
        <h1>JOIAS QUE CONTAM HISTÓRIAS</h1>
        <h2>Encontre peças especiais para você</h2>

        <a href="<?php echo get_permalink(19); ?>" class="btn">
            Ver Produtos
        </a>
    </section>

    <section class="destaque">
        <h1>Conheça nossos produtos</h1>

        <p>
            Explore nossa coleção de joias exclusivas e encontre a peça perfeita
            para você ou para presentear alguém especial.
        </p>

        <?php

        $products = array();

        if (function_exists('wc_get_products')) {
            $products = wc_get_products(array(
                'limit' => 4
            ));
        }

        ?>

        <div class="products-grid">

            <?php foreach ($products as $product) { ?>

                <div class="product">

                    <h2>
                        <?php echo $product->get_name(); ?>
                    </h2>

                    <p>
                        <?php echo $product->get_price_html(); ?>
                    </p>

                    <?php echo $product->get_image(); ?>

                    <a href="<?php echo $product->get_permalink(); ?>" class="btn">
                        Ver Produto
                    </a>

                </div>

            <?php } ?>

        </div>

    </section>

</main>

<?php get_footer(); ?>