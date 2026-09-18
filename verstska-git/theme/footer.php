<?php
defined( 'ABSPATH' ) || exit;
$email = verstkadoc_site_option( 'contact_email', get_theme_mod( 'verstkadoc_email', '' ) );
?>
</main>
<footer class="footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="brand">
                    <div class="brand-mark" aria-hidden="true"></div>
                    <div class="brand-word">VERSTKADOC <span><?php echo esc_html( verstkadoc_site_option( 'brand_tag', verstkadoc_text( 'brand_tag' ) ) ); ?></span></div>
                </div>
                <p>
                    <?php
                    echo esc_html(
                        verstkadoc_site_option(
                            'footer_description',
                            verstkadoc_is_russian()
                                ? 'DTP / document formatting для переводческих и локализационных компаний. Вёрстка, восстановление документов и мультиязычное форматирование.'
                                : 'DTP / document formatting for translation and localization companies. Layout, document reconstruction and multilingual formatting.'
                        )
                    );
                    ?>
                </p>
                <?php if ( $email ) : ?>
                    <p><a class="footer-email" href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></p>
                <?php endif; ?>
            </div>

            <div>
                <strong><?php echo esc_html( verstkadoc_site_option( 'footer_sections_title', verstkadoc_is_russian() ? 'Разделы' : 'Sections' ) ); ?></strong>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'footer-links',
                        'fallback_cb'    => false,
                    )
                );
                ?>
            </div>

            <div>
                <strong><?php echo esc_html( verstkadoc_site_option( 'footer_work_title', verstkadoc_is_russian() ? 'Работа' : 'Work' ) ); ?></strong>
                <div class="footer-links">
                    <a href="<?php echo esc_url( verstkadoc_page_url( 'dlya-byuro-perevodov', 'for-translation-agencies' ) ); ?>"><?php echo esc_html( verstkadoc_text( 'menu_agencies' ) ); ?></a>
                    <a href="<?php echo esc_url( verstkadoc_page_url( 'dlya-pryamyh-zakazchikov', 'for-direct-clients' ) ); ?>"><?php echo esc_html( verstkadoc_home_text( 'direct_clients_label' ) ); ?></a>
                    <a href="<?php echo esc_url( verstkadoc_page_url( 'rasschitat-stoimost', 'get-a-quote' ) ); ?>"><?php echo esc_html( verstkadoc_text( 'menu_quote' ) ); ?></a>
                </div>
            </div>
        </div>

        <div class="bottom">
            <div>© <span data-year></span> VERSTKADOC</div>
            <div>WordPress · Custom theme</div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
