<?php
/**
 * Small set of site presentation settings.
 */

defined( 'ABSPATH' ) || exit;

function verstkadoc_customize_register( $wp_customize ) {
    $wp_customize->add_section(
        'verstkadoc_theme_settings',
        array(
            'title'       => __( 'VERSTKADOC Settings', 'verstkadoc' ),
            'priority'    => 30,
            'description' => __( 'Basic presentation and language links for the two VERSTKADOC sites.', 'verstkadoc' ),
        )
    );

    $fields = array(
        'verstkadoc_ru_url' => array(
            'label'   => __( 'Russian site URL', 'verstkadoc' ),
            'default' => 'https://verstkadoc.ru/',
        ),
        'verstkadoc_en_url' => array(
            'label'   => __( 'English site URL', 'verstkadoc' ),
            'default' => 'https://verstkadoc.com/',
        ),
        'verstkadoc_email' => array(
            'label'   => __( 'Contact email', 'verstkadoc' ),
            'default' => '',
        ),
    );

    foreach ( $fields as $id => $field ) {
        $wp_customize->add_setting(
            $id,
            array(
                'default'           => $field['default'],
                'sanitize_callback' => ( false !== strpos( $id, 'email' ) ) ? 'sanitize_email' : 'esc_url_raw',
                'transport'         => 'refresh',
            )
        );

        $wp_customize->add_control(
            $id,
            array(
                'label'   => $field['label'],
                'section' => 'verstkadoc_theme_settings',
                'type'    => 'text',
            )
        );
    }
}
add_action( 'customize_register', 'verstkadoc_customize_register' );
