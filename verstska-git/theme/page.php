<?php get_header(); ?>
<section class="page-hero">
    <div class="container">
        <?php verstkadoc_breadcrumbs(); ?>
        <div class="eyebrow"><?php echo esc_html( verstkadoc_is_russian() ? 'Страница' : 'Page' ); ?></div>
        <h1><?php the_title(); ?></h1>
    </div>
</section>
<div class="section content-section">
    <div class="container content-grid">
        <article class="article">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php the_content(); ?>
                <?php
                wp_link_pages(
                    array(
                        'before' => '<nav class="page-links">' . esc_html__( 'Pages:', 'verstkadoc' ),
                        'after'  => '</nav>',
                    )
                );
                ?>
            <?php endwhile; ?>
        </article>
    </div>
</div>
<?php get_footer(); ?>
