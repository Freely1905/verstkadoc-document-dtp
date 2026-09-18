<?php
if ( post_password_required() ) {
    return;
}
?>
<section id="comments" class="comments-area">
    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title"><?php echo esc_html( verstkadoc_is_russian() ? 'Комментарии' : 'Comments' ); ?></h2>
        <ol class="comment-list">
            <?php wp_list_comments(); ?>
        </ol>
        <?php the_comments_navigation(); ?>
    <?php endif; ?>

    <?php comment_form(); ?>
</section>
