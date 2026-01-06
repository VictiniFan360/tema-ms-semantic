</main>

<footer class="site-footer">
    <div class="container footer-inner">

        <div class="footer-columns">

            <!-- Columna 1: General -->
            <section class="footer-column">
                <h3 class="footer-title"><?php bloginfo('name'); ?></h3>
                <?php
                if ( has_nav_menu( 'footer_general' ) ) {
                    wp_nav_menu([
                        'theme_location' => 'footer_general',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'depth'          => 1,
                    ]);
                } else {
                    semantic_wp_footer_fallback( 'footer_general' );
                }
                ?>
            </section>

            <!-- Columna 2: Soporte -->
            <section class="footer-column">
                <h3 class="footer-title"><?php _e('Soporte', 'semantic-wp'); ?></h3>
                <?php
                if ( has_nav_menu( 'footer_support' ) ) {
                    wp_nav_menu([
                        'theme_location' => 'footer_support',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'depth'          => 1,
                    ]);
                } else {
                    semantic_wp_footer_fallback( 'footer_support' );
                }
                ?>
            </section>

            <!-- Columna 3: Colaborá -->
            <section class="footer-column">
                <h3 class="footer-title"><?php _e('Colaborá', 'semantic-wp'); ?></h3>
                <?php
                if ( has_nav_menu( 'footer_collab' ) ) {
                    wp_nav_menu([
                        'theme_location' => 'footer_collab',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'depth'          => 1,
                    ]);
                } else {
                    semantic_wp_footer_fallback( 'footer_collab' );
                }
                ?>
            </section>

            <!-- Columna 4: Acerca de -->
            <section class="footer-column">
                <h3 class="footer-title"><?php _e('Acerca de', 'semantic-wp'); ?></h3>
                <?php
                if ( has_nav_menu( 'footer_about' ) ) {
                    wp_nav_menu([
                        'theme_location' => 'footer_about',
                        'container'      => false,
                        'menu_class'     => 'footer-menu',
                        'depth'          => 1,
                    ]);
                } else {
                    semantic_wp_footer_fallback( 'footer_about' );
                }
                ?>
            </section>

        </div>

        <p class="copyright">
            &copy; <?php echo esc_html( date('Y') ); ?>
            <?php echo esc_html(
                get_theme_mod(
                    'semantic_wp_copyright_text',
                    get_bloginfo('name')
                )
            ); ?>
        </p>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>



