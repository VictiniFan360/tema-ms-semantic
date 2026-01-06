<?php
/**
 * MS Semantic WP – Functions
 * Tema semántico, accesible y personalizable
 */

/* --------------------------------------------------
 * Setup del tema
 * -------------------------------------------------- */
function semantic_wp_setup() {

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    register_nav_menus([
        'primary'        => __('Menú principal', 'semantic-wp'),
        'footer_general' => __('Footer – General', 'semantic-wp'),
        'footer_about'   => __('Footer – Acerca de', 'semantic-wp'),
    ]);
}
add_action('after_setup_theme', 'semantic_wp_setup');

/* --------------------------------------------------
 * Assets
 * -------------------------------------------------- */
function semantic_wp_assets() {

    wp_enqueue_style('semantic-wp-base', get_stylesheet_uri(), [], wp_get_theme()->get('Version'));
    wp_enqueue_style('semantic-wp-main', get_template_directory_uri() . '/css/main.css', ['semantic-wp-base'], wp_get_theme()->get('Version'));
    wp_enqueue_style('style-tablet', get_template_directory_uri() . '/css/style-tablet.css', ['semantic-wp-main'], wp_get_theme()->get('Version'));
    wp_enqueue_style('style-mobile', get_template_directory_uri() . '/css/style-mobile.css', ['semantic-wp-main'], wp_get_theme()->get('Version'));

    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', [], '5.3.3');
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.bundle.min.js', [], '5.3.3', true);
}
add_action('wp_enqueue_scripts', 'semantic_wp_assets');

/* --------------------------------------------------
 * Widgets
 * -------------------------------------------------- */
function semantic_wp_widgets() {
    register_sidebar([
        'name' => __('Sidebar Derecha', 'semantic-wp'),
        'id' => 'sidebar-right',
        'before_widget' => '<aside class="widget recommended-posts">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ]);
}
add_action('widgets_init', 'semantic_wp_widgets');

/* --------------------------------------------------/
 * Footer fallback
 * -------------------------------------------------- */
function semantic_wp_footer_fallback($location) {

    $defaults = [
        'footer_general' => [
            'Inicio' => home_url('/'),
            'Acerca de nosotros' => get_permalink(get_page_by_path('acerca-de')),
        ],
        'footer_about' => [
            'Términos y condiciones' => get_permalink(get_page_by_path('terminos-y-condiciones')),
            'Política de Privcidad' => get_permalink(get_page_by_path('privacidad')),
            'Disclaimers' => get_permalink(get_page_by_path('disclaimers')),
        ],
    ];

    if (empty($defaults[$location])) return;

    echo '<ul class="footer-menu">';
    foreach ($defaults[$location] as $label => $url) {
        if ($url) {
            echo '<li><a href="' . esc_url($url) . '">' . esc_html($label) . '</a></li>';
        }
    }
    echo '</ul>';
}

/* --------------------------------------------------
 * Customizer
 * -------------------------------------------------- */
function semantic_wp_customize($wp_customize) {

    /* Logo */
    $wp_customize->add_setting('semantic_wp_logo', ['sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'semantic_wp_logo',
        ['label' => __('Logo', 'semantic-wp'), 'section' => 'title_tagline']
    ));

    /* Colores base */
    $colors = [
        'semantic_wp_header_color' => ['Color del header', '#241F31'],
        'semantic_wp_footer_color' => ['Color del footer', '#241F31'],
        'semantic_wp_link_color'   => ['Color de links', '#005A9C'],
    ];

    foreach ($colors as $id => [$label, $default]) {
        $wp_customize->add_setting($id, ['default' => $default, 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            $id,
            ['label' => __($label, 'semantic-wp'), 'section' => 'colors']
        ));
    }

    /* Fuente */
    $wp_customize->add_setting('semantic_wp_font_family', [
        'default' => 'system-ui, sans-serif',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    $wp_customize->add_control('semantic_wp_font_family', [
        'label' => __('Fuente del sitio', 'semantic-wp'),
        'section' => 'colors',
        'type' => 'select',
        'choices' => [
            'system-ui, sans-serif' => 'Sistema',
            'Georgia, serif' => 'Serif',
            'Courier New, monospace' => 'Monoespaciada',
        ],
    ]);

    /* TopBar */
    $wp_customize->add_setting('semantic_wp_topbar_enable', ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
    $wp_customize->add_control('semantic_wp_topbar_enable', [
        'label' => __('Mostrar TopBar', 'semantic-wp'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
    ]);

    $wp_customize->add_setting('semantic_wp_topbar_underline', ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
    $wp_customize->add_control('semantic_wp_topbar_underline', [
        'label' => __('Subrayado del TopBar', 'semantic-wp'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
    ]);

    $wp_customize->add_setting('semantic_wp_topbar_link_underline', ['default' => true, 'sanitize_callback' => 'wp_validate_boolean']);
    $wp_customize->add_control('semantic_wp_topbar_link_underline', [
        'label' => __('Subrayar link del TopBar', 'semantic-wp'),
        'section' => 'title_tagline',
        'type' => 'checkbox',
    ]);

    $wp_customize->add_setting('semantic_wp_topbar_text', ['default' => 'Sitio Oficial', 'sanitize_callback' => 'sanitize_text_field']);
    $wp_customize->add_control('semantic_wp_topbar_text', [
        'label' => __('Texto del TopBar', 'semantic-wp'),
        'section' => 'title_tagline',
    ]);

    $wp_customize->add_setting('semantic_wp_topbar_link', ['sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control('semantic_wp_topbar_link', [
        'label' => __('Link del TopBar', 'semantic-wp'),
        'section' => 'title_tagline',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('semantic_wp_topbar_color', ['default' => '#003366', 'sanitize_callback' => 'sanitize_hex_color']);
    $wp_customize->add_control(new WP_Customize_Color_Control(
        $wp_customize,
        'semantic_wp_topbar_color',
        ['label' => __('Color del TopBar', 'semantic-wp'), 'section' => 'colors']
    ));

    $wp_customize->add_setting('semantic_wp_topbar_bg', ['sanitize_callback' => 'esc_url_raw']);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'semantic_wp_topbar_bg',
        ['label' => __('Imagen del TopBar', 'semantic-wp'), 'section' => 'title_tagline']
    ));

    /* NavBar */
    $nav_colors = [
        'semantic_wp_nav_link_color' => ['Color base links NavBar', '#000000'],
        'semantic_wp_nav_active_color' => ['Color activo / hover', '#000000'],
        'semantic_wp_nav_hover_bg' => ['Fondo hover', '#f0f0f0'],
        'semantic_wp_nav_sublink_color' => ['Color sublinks', '#000000'],
    ];

    foreach ($nav_colors as $id => [$label, $default]) {
        $wp_customize->add_setting($id, ['default' => $default, 'sanitize_callback' => 'sanitize_hex_color']);
        $wp_customize->add_control(new WP_Customize_Color_Control(
            $wp_customize,
            $id,
            ['label' => __($label, 'semantic-wp'), 'section' => 'colors']
        ));
    }

    /* Copyright */
    $wp_customize->add_setting('semantic_wp_copyright_text', [
        'default' => get_bloginfo('name'),
        'sanitize_callback' => 'sanitize_text_field'
    ]);
    $wp_customize->add_control('semantic_wp_copyright_text', [
        'label' => __('Texto del copyright', 'semantic-wp'),
        'section' => 'title_tagline',
    ]);
}
add_action('customize_register', 'semantic_wp_customize');

/* --------------------------------------------------
 * CSS dinámico
 * -------------------------------------------------- */
function semantic_wp_customizer_css() {

    $topbar_border = get_theme_mod('semantic_wp_topbar_underline', true) ? '1px solid currentColor' : 'none';
    $topbar_link_decoration = get_theme_mod('semantic_wp_topbar_link_underline', true) ? 'underline' : 'none';

    echo '<style>:root{';
    echo '--semantic-header-color:' . esc_attr(get_theme_mod('semantic_wp_header_color')) . ';';
    echo '--semantic-footer-color:' . esc_attr(get_theme_mod('semantic_wp_footer_color')) . ';';
    echo '--semantic-link-color:' . esc_attr(get_theme_mod('semantic_wp_link_color')) . ';';
    echo '--semantic-font-family:' . esc_attr(get_theme_mod('semantic_wp_font_family')) . ';';
    echo '--semantic-topbar-color:' . esc_attr(get_theme_mod('semantic_wp_topbar_color')) . ';';
    echo '--semantic-topbar-underline:' . $topbar_border . ';';
    echo '--semantic-topbar-link-decoration:' . $topbar_link_decoration . ';';
    echo '--semantic-nav-link-color:' . esc_attr(get_theme_mod('semantic_wp_nav_link_color')) . ';';
    echo '--semantic-nav-active-color:' . esc_attr(get_theme_mod('semantic_wp_nav_active_color')) . ';';
    echo '--semantic-nav-hover-bg:' . esc_attr(get_theme_mod('semantic_wp_nav_hover_bg')) . ';';
    echo '--semantic-nav-sublink-color:' . esc_attr(get_theme_mod('semantic_wp_nav_sublink_color')) . ';';

    if ($logo = get_theme_mod('semantic_wp_logo')) {
        echo '--semantic-logo-bg:url(' . esc_url($logo) . ');';
    }
    if ($bg = get_theme_mod('semantic_wp_topbar_bg')) {
        echo '--semantic-topbar-bg:url(' . esc_url($bg) . ');';
    }
    echo '}</style>';
}
add_action('wp_head', 'semantic_wp_customizer_css');

/* --------------------------------------------------
 * Query
 * -------------------------------------------------- */
function semantic_wp_posts_per_page($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_archive()) {
        $query->set('posts_per_page', 9);
    }
}
add_action('pre_get_posts', 'semantic_wp_posts_per_page');

/* --------------------------------------------------
 * Entradas recomendadas
 * -------------------------------------------------- */
function semantic_wp_recommended_posts($count = 4) {

    $recommended = new WP_Query([
        'posts_per_page' => $count,
        'orderby' => 'rand',
        'post_status' => 'publish',
    ]);

    if ($recommended->have_posts()) :
        echo '<section class="recommended-posts">';
        echo '<h2>Entradas recomendadas</h2>';
        echo '<div class="row g-3">';

        while ($recommended->have_posts()) : $recommended->the_post(); ?>
            <article class="col-12">
                <div class="card h-100">
                    <?php if (has_post_thumbnail()) the_post_thumbnail('medium', ['class' => 'card-img-top']); ?>
                    <div class="card-body d-flex flex-column">
                        <h3><?php the_title(); ?></h3>
                        <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-auto">Leer más</a>
                    </div>
                </div>
            </article>
        <?php endwhile;

        echo '</div></section>';
        wp_reset_postdata();
    endif;
}
