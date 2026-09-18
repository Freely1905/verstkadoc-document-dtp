<?php get_header(); ?>
<section class="page-hero">
    <div class="container">
        <?php verstkadoc_breadcrumbs(); ?>
        <div class="eyebrow"><?php echo esc_html( verstkadoc_is_russian() ? 'Архив' : 'Archive' ); ?></div>
        <h1><?php the_archive_title(); ?></h1>
        <?php the_archive_description( '<div class="lead">', '</div>' ); ?>
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
            <p><?php esc_html_e( 'Nothing found.', 'verstkadoc' ); ?></p>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?>
