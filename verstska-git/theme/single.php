<?php get_header(); ?>
<section class="page-hero">
    <div class="container">
        <?php verstkadoc_breadcrumbs(); ?>
        <div class="eyebrow"><?php echo esc_html( verstkadoc_is_russian() ? 'База знаний' : 'Knowledge' ); ?></div>
        <?php the_title( '<h1>', '</h1>' ); ?>
        <div class="entry-meta"><?php verstkadoc_posted_on(); ?></div>
    </div>
</section>
<div class="section content-section">
    <div class="container content-grid">
        <article class="article">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="featured-image"><?php the_post_thumbnail( 'large' ); ?></div>
                <?php endif; ?>
                <?php the_content(); ?>
                <?php wp_link_pages( array( 'before' => '<nav class="page-links">' . esc_html__( 'Pages:', 'verstkadoc' ), 'after' => '</nav>' ) ); ?>
            <?php endwhile; ?>
        </article>
        <aside class="side">
            <strong><?php echo esc_html( verstkadoc_is_russian() ? 'Разделы' : 'Sections' ); ?></strong>
            <a href="<?php echo esc_url( verstkadoc_page_url( 'uslugi', 'services' ) ); ?>"><?php echo esc_html( verstkadoc_text( 'menu_home' ) ); ?></a>
            <a href="<?php echo esc_url( verstkadoc_page_url( 'portfolio' ) ); ?>"><?php echo esc_html( verstkadoc_text( 'menu_cases' ) ); ?></a>
            <a href="<?php echo esc_url( verstkadoc_page_url( 'rasschitat-stoimost', 'get-a-quote' ) ); ?>"><?php echo esc_html( verstkadoc_text( 'menu_quote' ) ); ?></a>
        </aside>
    </div>
</div>
<?php get_footer(); ?>
