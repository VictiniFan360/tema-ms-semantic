<?php get_header(); ?>

<section class="post-grid">
<?php
$query = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 9,
    'paged' => get_query_var('paged') ?: 1
]);
?>

<?php if ($query->have_posts()) : ?>
    <div class="grid">
    <?php while ($query->have_posts()) : $query->the_post(); ?>
        <article <?php post_class('card'); ?>>
            <?php if (has_post_thumbnail()) : ?>
                <figure>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                    </a>
                </figure>
            <?php endif; ?>

            <h2><?php the_title(); ?></h2>
            <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>

            <a class="button" href="<?php the_permalink(); ?>">Leer más</a>
        </article>
    <?php endwhile; ?>
    </div>
<?php endif; wp_reset_postdata(); ?>
</section>

<?php get_footer(); ?>