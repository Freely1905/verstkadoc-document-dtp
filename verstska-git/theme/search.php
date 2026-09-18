<?php get_header(); ?>
<section class="page-hero">
    <div class="container">
        <?php verstkadoc_breadcrumbs(); ?>
        <div class="eyebrow"><?php echo esc_html( verstkadoc_is_russian() ? 'Поиск' : 'Search' ); ?></div>
        <h1><?php printf( esc_html__( 'Search: %s', 'verstkadoc' ), esc_html( get_search_query() ) ); ?></h1>
    </div>
</section>
<div class="section">
    <div class="container post-list">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', get_post_type() ); ?>
            <?php endwhile; ?>
            <?php the_posts_pagination(); ?>
        <?php else : ?>
            <p><?php echo esc_html( verstkadoc_is_russian() ? 'Ничего не найдено.' : 'Nothing found.' ); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
