<?php get_header(); ?>

<div class="container mt-4">
    <div class="row">
        <main class="col-lg-8 single-post">

            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                <article>
                    <header class="single-header mb-3">
                        <h1 class="single-title"><?php the_title(); ?></h1>
                        <p class="single-meta">
                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                <?php echo get_the_date(); ?>
                            </time>
                        </p>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <figure class="single-thumbnail mb-3">
                            <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                        </figure>
                    <?php endif; ?>

                    <section class="single-content mb-4">
                        <?php the_content(); ?>
                    </section>

                    <nav class="single-navigation mb-4" aria-label="Navegación entre entradas">
                        <div class="nav-previous">
                            <?php previous_post_link('%link', '← Entrada anterior'); ?>
                        </div>
                        <div class="nav-next">
                            <?php next_post_link('%link', 'Entrada siguiente →'); ?>
                        </div>
                    </nav>
                </article>

            <?php endwhile; endif; ?>

        </main>
        <aside class="col-lg-4">
            <?php semantic_wp_recommended_posts(4); ?>
        </aside>

    </div>
</div>

<?php get_footer(); ?>
