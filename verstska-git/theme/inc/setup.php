<?php
/**
 * Theme setup and assets.
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'verstkadoc_setup' ) ) {
    function verstkadoc_setup() {
        load_theme_textdomain( 'verstkadoc', get_template_directory() . '/languages' );

        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-logo', array(
            'height'      => 80,
            'width'       => 360,
            'flex-height' => true,
            'flex-width'  => true,
        ) );
        add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
        add_theme_support( 'editor-styles' );
        add_editor_style( 'assets/css/editor.css' );

        register_nav_menus( array(
            'primary' => __( 'Header Menu', 'verstkadoc' ),
            'footer'  => __( 'Footer Menu', 'verstkadoc' ),
        ) );
    }
}
add_action( 'after_setup_theme', 'verstkadoc_setup' );

function verstkadoc_enqueue_assets() {
    $theme_uri  = get_template_directory_uri();
    $theme_path = get_template_directory();
    $css_file   = $theme_path . '/assets/css/theme.css';
    $js_file    = $theme_path . '/assets/js/main.js';

    wp_enqueue_style(
        'verstkadoc-theme',
        $theme_uri . '/assets/css/theme.css',
        array(),
        file_exists( $css_file ) ? filemtime( $css_file ) : '0.1.0'
    );

    wp_enqueue_script(
        'verstkadoc-theme',
        $theme_uri . '/assets/js/main.js',
        array(),
        file_exists( $js_file ) ? filemtime( $js_file ) : '0.1.0',
        true
    );
}
add_action( 'wp_enqueue_scripts', 'verstkadoc_enqueue_assets' );

function verstkadoc_content_width() {
    $GLOBALS['content_width'] = 780;
}
add_action( 'after_setup_theme', 'verstkadoc_content_width', 0 );

function verstkadoc_body_classes( $classes ) {
    if ( is_front_page() ) {
        $classes[] = 'is-front-page';
    }

    if ( is_page_template() ) {
        $classes[] = 'has-page-template';
    }

    return $classes;
}
add_filter( 'body_class', 'verstkadoc_body_classes' );
