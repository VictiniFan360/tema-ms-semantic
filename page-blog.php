<?php
/**
 * Template Name: Blog
 * Página de listado de entradas
 */

get_header();
?>

<section class="container my-5">
    <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => 9,
        'paged'          => $paged,
    ];

    $blog_query = new WP_Query($args);
    ?>

    <?php if ($blog_query->have_posts()) : ?>
        <div class="row g-4">
            <?php while ($blog_query->have_posts()) : $blog_query->the_post(); ?>
                <div class="col-md-4">
                    <article <?php post_class('card h-100'); ?> role="article">
                        
                        <?php if (has_post_thumbnail()) : ?>
                            <figure class="mb-0">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                                </a>
                            </figure>
                        <?php endif; ?>

                        <div class="card-body d-flex flex-column">
                            <h2 class="card-title h5">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?>
                                </a>
                            </h2>

                            <p class="card-text">
                                <?php echo esc_html(wp_trim_words(get_the_excerpt(), 20, '…')); ?>
                            </p>

                            <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-auto">
                                Ver más
                            </a>
                        </div>
                    </article>
                </div>
            <?php endwhile; ?>
        </div>

        <nav class="mt-4" aria-label="Paginación del blog">
            <?php
            echo paginate_links([
                'total'     => $blog_query->max_num_pages,
                'prev_text' => '« Anterior',
                'next_text' => 'Siguiente »',
                'type'      => 'list',
            ]);
            ?>
        </nav>

        <?php wp_reset_postdata(); ?>

    <?php else : ?>
        <p><?php esc_html_e('No hay entradas para mostrar.', 'semantic-wp'); ?></p>
    <?php endif; ?>
</section>

<?php get_footer(); ?>