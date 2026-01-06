<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<a href="#contenido-principal" class="skip-link">
    Saltar al contenido principal
</a>

<?php if ( get_theme_mod( 'semantic_wp_topbar_enable', true ) ) : ?>
    <div class="site-topbar">
        <?php if ( get_theme_mod( 'semantic_wp_topbar_bg' ) ) : ?>
            <div class="topbar-logo" aria-hidden="true"></div>
        <?php endif; ?>

        <div class="topbar-text">
            <?php if ( get_theme_mod( 'semantic_wp_topbar_link' ) ) : ?>
                <a
                    href="<?php echo esc_url( get_theme_mod( 'semantic_wp_topbar_link' ) ); ?>"
                    class="topbar-link"
                >
                    <?php echo esc_html(
                        get_theme_mod( 'semantic_wp_topbar_text', 'Sitio Oficial' )
                    ); ?>
                </a>
            <?php else : ?>
                <?php echo esc_html(
                    get_theme_mod( 'semantic_wp_topbar_text', 'Sitio Oficial' )
                ); ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>

<header class="site-header p-3 mb-3 text-white">
    <div class="container">

        <nav
            class="navbar navbar-expand-lg navbar-dark p-0"
            aria-label="<?php esc_attr_e( 'Menú principal', 'semantic-wp' ); ?>"
        >

            <h1 class="site-branding mb-0">
                <a
                    id="logo"
                    class="navbar-brand logo-bg"
                    href="<?php echo esc_url( home_url( '/' ) ); ?>"
                    title="<?php bloginfo( 'name' ); ?>"
                >
                    <span class="visually-hidden">
                        <?php bloginfo( 'name' ); ?>
                    </span>
                </a>
            </h1>

            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#main-menu"
                aria-controls="main-menu"
                aria-expanded="false"
                aria-label="<?php esc_attr_e( 'Abrir menú', 'semantic-wp' ); ?>"
            >
                <span class="navbar-toggler-icon"></span>
                <span class="visually-hidden">
                    <?php esc_html_e( 'Abrir menú', 'semantic-wp' ); ?>
                </span>
            </button>

            <div class="collapse navbar-collapse" id="main-menu">
                <?php
                wp_nav_menu( [
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav ms-auto mb-2 mb-lg-0',
                    'fallback_cb'    => false,
                    'walker'         => new class extends Walker_Nav_Menu {

                        function start_lvl( &$output, $depth = 0, $args = null ) {
                            $output .= '<ul class="dropdown-menu">';
                        }

                        function end_lvl( &$output, $depth = 0, $args = null ) {
                            $output .= '</ul>';
                        }

                        function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

                            $has_children = in_array(
                                'menu-item-has-children',
                                $item->classes,
                                true
                            );

                            $li_class   = $has_children ? 'nav-item dropdown' : 'nav-item';
                            $link_class = $has_children
                                ? 'nav-link dropdown-toggle'
                                : 'nav-link';

                            $output .= '<li class="' . esc_attr( $li_class ) . '">';
                            $output .= '<a class="' . esc_attr( $link_class ) . '" href="' . esc_url( $item->url ) . '">';
                            $output .= esc_html( $item->title );
                            $output .= '</a>';
                        }

                        function end_el( &$output, $item, $depth = 0, $args = null ) {
                            $output .= '</li>';
                        }
                    },
                ] );
                ?>
            </div>

        </nav>

    </div>
</header>

<main id="contenido-principal" class="container mt-4">
