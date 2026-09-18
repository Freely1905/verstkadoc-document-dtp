<?php
defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link screen-reader-text" href="#main-content"><?php esc_html_e( 'Skip to content', 'verstkadoc' ); ?></a>
<header class="site-header">
    <div class="container">
        <div class="nav">
            <a class="brand-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <div class="brand">
                    <div class="brand-mark" aria-hidden="true"></div>
                    <div class="brand-word">VERSTKADOC <span><?php echo esc_html( verstkadoc_site_option( 'brand_tag', verstkadoc_text( 'brand_tag' ) ) ); ?></span></div>
                </div>
            </a>

            <button class="menu" type="button" aria-controls="primary-navigation" aria-expanded="false">
                <span class="screen-reader-text"><?php esc_html_e( 'Open menu', 'verstkadoc' ); ?></span>
                <span aria-hidden="true">☰</span>
            </button>

            <nav id="primary-navigation" class="nav-links" aria-label="<?php esc_attr_e( 'Primary menu', 'verstkadoc' ); ?>">
                <?php
                if ( has_nav_menu( 'primary' ) ) {
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'container'      => false,
                            'menu_id'        => 'primary-menu',
                            'menu_class'     => 'primary-menu',
                            'fallback_cb'    => 'verstkadoc_fallback_primary_menu',
                            'depth'          => 2,
                        )
                    );
                } else {
                    verstkadoc_fallback_primary_menu();
                }
                ?>
                <?php verstkadoc_language_links(); ?>
            </nav>
        </div>
    </div>
</header>
<main id="main-content" class="site-main">
