<?php get_header(); ?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <article <?php post_class(); ?>>
            <header>
                <h2><?php the_title(); ?></h2>
            </header>

            <section>
                <?php the_content(); ?>
            </section>
        </article>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>