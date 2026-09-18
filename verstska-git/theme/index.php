<?php
get_header();
?>
<section class="page-hero">
    <div class="container">
        <div class="eyebrow"><?php echo esc_html( verstkadoc_is_russian() ? 'Материалы' : 'Content' ); ?></div>
        <h1><?php echo esc_html( verstkadoc_is_russian() ? 'Публикации и страницы' : 'Posts and pages' ); ?></h1>
    </div>
</section>
<div class="section">
    <div class="container">
        <div class="post-list">
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
</div>
<?php get_footer(); ?>
