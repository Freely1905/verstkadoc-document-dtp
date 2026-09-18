<?php
get_header();
?>
<div class="container page-wrap">
    <?php verstkadoc_breadcrumbs(); ?>
    <article class="page-article">
        <?php while ( have_posts() ) : the_post(); ?>
            <div class="eyebrow"><?php echo esc_html( verstkadoc_is_russian() ? 'Услуга' : 'Service' ); ?></div>
            <h1><?php the_title(); ?></h1>
            <?php if ( has_excerpt() ) : ?><p class="lead"><?php echo esc_html( get_the_excerpt() ); ?></p><?php endif; ?>
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
