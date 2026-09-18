<?php
get_header();
?>
<div class="container page-wrap">
    <?php verstkadoc_breadcrumbs(); ?>
    <article class="page-article">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="eyebrow"><?php echo esc_html( function_exists( 'vd_get_case_meta' ) ? vd_get_case_meta( get_the_ID(), verstkadoc_is_russian() ? 'Кейс' : 'Case' ) : ( verstkadoc_is_russian() ? 'Кейс' : 'Case' ) ); ?></div>
            <h1><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php
                if ( trim( get_the_content() ) ) {
                    the_content();
                } elseif ( function_exists( 'vd_get_summary' ) ) {
                    echo wp_kses_post( wpautop( vd_get_summary( get_the_ID(), '' ) ) );
                }
                ?>
            </div>
        <?php endwhile; ?>
    </article>
</div>
<?php get_footer(); ?>
