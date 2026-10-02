<?php get_header(); ?>

<main class="page-content">

    <?php if (have_posts()) { ?>

        <?php while (have_posts()) { ?>

            <?php the_post(); ?>

            <article>

                <h1>
                    <?php the_title(); ?>
                </h1>

                <div class="page-body">
                    <?php the_content(); ?>
                </div>

            </article>

        <?php } ?>

    <?php } ?>

</main>

<?php get_footer(); ?>