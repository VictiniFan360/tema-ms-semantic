<?php get_header(); ?>

<section class="archive-content container mt-4">
    <header class="archive-header">
        <h1 class="archive-title">
            <?php the_archive_title(); ?>
        </h1>

        <?php if (the_archive_description()) : ?>
            <div class="archive-description">
                <?php the_archive_description(); ?>
            </div>
        <?php endif; ?>
    </header>

    <?php if (have_posts()) : ?>
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('col'); ?>>
                    <div class="card h-100">
                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="card-img-top">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium_large', ['class' => 'img-fluid']); ?>
                                </a>
                            </figure>
                        <?php endif; ?>

                        <div class="card-body">
                            <h2 class="card-title">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <p class="card-text">
                                <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                            </p>

                            <a href="<?php the_permalink(); ?>" class="button">
                                Ver más
                            </a>
                        </div>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <nav class="archive-pagination mt-4" aria-label="Paginación">
            <?php
            the_posts_pagination([
                'mid_size'  => 2,
                'prev_text' => '« Anterior',
                'next_text' => 'Siguiente »',
            ]);
            ?>
        </nav>

    <?php else : ?>
        <p>No hay contenido disponible.</p>
    <?php endif; ?>
</section>

<?php get_footer(); ?>