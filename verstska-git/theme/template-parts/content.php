<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
    <div class="eyebrow"><?php echo esc_html( get_post_type() ); ?></div>
    <?php the_title( '<h2 class="post-card-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' ); ?>
    <div class="entry-meta"><?php verstkadoc_posted_on(); ?></div>
    <div class="post-card-excerpt">
        <?php the_excerpt(); ?>
    </div>
</article>
